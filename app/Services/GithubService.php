<?php
/**
 * Creator: Pablo Miranda
 * Date: 2022/05/25 16:18
 */

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GithubService
{

    public function pullRepos(string $username)
    {
        $a = Http::get('https://api.github.com/users/' . $username . '/repos');

        //get repos and save to json file
        $repos = $a->json();
        $repos = json_encode($repos);
        $responseArray = [];
        file_put_contents(storage_path("app/users/{$username}.json"), $repos);
        $repoArray = json_decode($repos, true);
        foreach ($repoArray as $item) {
            $responseArray[] = [
                'name' => $item['name'],
                'description' => $item['description'],
                'url' => $item['html_url'],
                'owner' => $item['owner']['login'],
                'language' => $item['language'],
                'updated' => $item['updated_at']
            ];
        }
        return $responseArray;
    }

    public function getAllRepos()
    {
        $repos = [];
        $dir = opendir(storage_path('app/users'));
        while ($file = readdir($dir)) {
            if ($file != '.' && $file != '..') {

                $res = json_decode(file_get_contents(storage_path("app/users/{$file}")), true);
                foreach ($res as $item) {
                    $repos[] = [
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'url' => $item['html_url'],
                        'owner' => $item['owner']['login'],
                        'language' => $item['language'],
                        'updated' => $item['updated_at']
                    ];
                }

                // Array is limit to 12 results according to the challenge
                if(count($repos) > 11){
                    $repos = array_slice($repos, 0, 10);
                }
            }
        }

        return $repos;

    }


}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Folder;
use App\Models\File;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Root Folders
        $rootFolders = [
            ['name' => 'Documents', 'parent_id' => null],
            ['name' => 'Music', 'parent_id' => null],
            ['name' => 'Pictures', 'parent_id' => null],
        ];

        foreach ($rootFolders as $rootFolder) {
            $this->createFolderWithSubfolders($rootFolder, 1);
        }
    }

    private function createFolderWithSubfolders($folderData, $level)
    {
        // Create the folder
        $folder = Folder::create($folderData);

        // Add files to the current folder
        $this->createFilesForFolder($folder);

        // Stop at level 3
        if ($level >= 3) {
            return;
        }

        // Define subfolders based on the folder name
        switch ($folder->name) {
            case 'Documents':
                $subfolders = [
                    ['name' => 'Work', 'parent_id' => $folder->id],
                    ['name' => 'Personal', 'parent_id' => $folder->id],
                ];
                break;

            case 'Work':
                $subfolders = [
                    ['name' => 'Projects', 'parent_id' => $folder->id],
                    ['name' => 'Reports', 'parent_id' => $folder->id],
                ];
                break;

            case 'Music':
                $subfolders = [
                    ['name' => 'Rock', 'parent_id' => $folder->id],
                    ['name' => 'Jazz', 'parent_id' => $folder->id],
                ];
                break;

            case 'Rock':
                $subfolders = [
                    ['name' => 'Classic Rock', 'parent_id' => $folder->id],
                    ['name' => 'Indie Rock', 'parent_id' => $folder->id],
                ];
                break;

            case 'Pictures':
                $subfolders = [
                    ['name' => 'Vacations', 'parent_id' => $folder->id],
                    ['name' => 'Family', 'parent_id' => $folder->id],
                ];
                break;

            case 'Vacations':
                $subfolders = [
                    ['name' => 'Summer 2023', 'parent_id' => $folder->id],
                    ['name' => 'Winter 2023', 'parent_id' => $folder->id],
                ];
                break;

            default:
                $subfolders = [];
                break;
        }

        // Recursively create subfolders up to 3 levels deep
        foreach ($subfolders as $subfolder) {
            $this->createFolderWithSubfolders($subfolder, $level + 1);
        }
    }

    private function createFilesForFolder($folder)
    {
        // Create 3 files in each folder
        for ($i = 1; $i <= 3; $i++) {
            File::create([
                'name' => $folder->name . '_File_' . $i . '.txt',
                'folder_id' => $folder->id,
            ]);
        }
    }
}

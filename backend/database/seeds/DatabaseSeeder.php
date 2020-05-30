

<?php

use App\User;
use App\Project;
use App\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $testuser = User::create([
            'name' => 'Alex',
            'email' => 'alex@test.com',
            'password' => Hash::make('alex123')
        ]);

        User::create([
            'name' => 'Julia',
            'email' => 'julia@test.com',
            'password' => Hash::make('julia321')
        ]);

        Project::create([
            'user_id' => User::where('name','Alex')->first()->id,
            'title' => 'Project',
            'description' => 'This is project',
            'imgUrl' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fpets.webmd.com%2Fcats%2Fcat-vaccines&psig=AOvVaw0_2CYNYUrhuFcCIbk9sOBR&ust=1590912204725000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCJCm8PiP2-kCFQAAAAAdAAAAABAI'
        ]);

        Contact::create([
            'project_id' => Project::where('title','Project')->first()->id,
            'contactType' => 'vk',
            'contactValue' => '@example'
        ]);

    }
}

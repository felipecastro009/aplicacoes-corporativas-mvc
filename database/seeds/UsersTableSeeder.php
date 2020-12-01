<?php

use Illuminate\Database\Seeder;
use App\Models\Auth\User;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Create felipe
    $felipe = User::create([
      'first_name' => 'Felipe',
      'last_name' => 'Castro',
      'email' => 'engfelipecastro@gmail.com',
      'phone' => null,
      'password' => bcrypt('senha'),
      'receive_messages' => true,
      'active' => true
    ]);


    // Assing role
    $felipe->assignRole('root');

  }
}

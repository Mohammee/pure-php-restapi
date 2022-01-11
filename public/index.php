<?php

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Config\Database\DatabaseHandle;
use App\Config\Database\PDODriver;
use App\Models\Post;

//header('accept:application/json');
//header('content-type:application/json');
//
//// get all posts
//$posts = [];
//foreach(Post::getAll() as $post){
//    extract(json_decode(json_encode($post) , true));
//
//     $posts[] = [
//         'id' => $id,
//         'title' => $title,
//         'body' => $body
//     ];
//};
//
////$response['posts'] = [];
////$response['status'] = [];
////
////array_push($response['status'] , )
////;
//
//echo response(Post::getAll() , 'posts' , 400);
//
////get one post
//$id = $_GET['id'];
//
//$post = new Post();
//echo response($post->find($id) , 'post');

//create post
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents('php://input'), true);
extract($data);

$post = new Post();
$post->id = $id;
$post->title = $title;
$post->body = $body;
$post->category_id = $category_id;

if ($post->store()) {
    echo json_encode([
        'message' => "Post create successfully."
    ]);
};



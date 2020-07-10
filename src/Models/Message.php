<?php

namespace App\Models;

class Message extends \App\Models\Base

{
    public function add($author_id, $text)
    {
        $lastInsertID = $this->microBlogMessagesTable
            ->newQuery()
            ->select('id')
            ->orderByDesc('id')
            ->limit(1)
            ->get()
            ->toArray();
        $this->microBlogMessagesTable->text = $text;
        $this->microBlogMessagesTable->created_at = date("y.m.d");
        $this->microBlogMessagesTable->author_id = $author_id;
        $result = $this->microBlogMessagesTable->save();
        return $result;
    }

    public function getAll()
    {
        $result = $this->microBlogMessagesTable
            ->newQuery()
            ->join('users', 'users.id', '=', 'messages.author_id')
            ->select('messages.id', 'text', 'messages.created_at', 'name')
            ->orderByDesc('id')
            ->limit(3)
            ->get()
            ->toArray();
        return $result;
    }

    public function getLastInsertId()
    {

//        $sql = "SELECT id FROM `messages` ORDER BY id DESC LIMIT 1";
//        $statement = $this->getConnect()->prepare($sql);
//        $statement->execute();
//        return $statement->fetch(\PDO::FETCH_ASSOC)["id"] +1;
          $result = $this->microBlogMessagesTable
              ->newQuery()
              ->select('id')
              ->orderByDesc('id')
              ->limit('1')
              ->get()
              ->toArray();

          return $result[0]['id'] + 1;

    }


    public function getAllById($id)
    {
        $result = $this->microBlogMessagesTable
            ->newQuery()
            ->select('text')
            ->where('author_id', '=', $id)
            ->get()
            ->toArray();
        return json_encode($result);
    }

    public function delete($id)
    {
        $result = $this->microBlogMessagesTable
            ->newQuery()
            ->where('id', '=', $id)
            ->delete();
        return $result;
    }


}




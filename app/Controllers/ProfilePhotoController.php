<?php
namespace App\Controllers;

class ProfilePhotoController
{
    public function show(int $id): void
    {
        $photo = (new \UserManager())->getProfilePhotoData($id);

        if ($photo === null) {
            http_response_code(404);
            return;
        }

        header('Content-Type: ' . $photo['profile_photo_mime']);
        header('Cache-Control: public, max-age=86400');
        echo $photo['profile_photo'];
    }
}
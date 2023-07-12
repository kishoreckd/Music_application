<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <title>Add Playlist</title>
</head>

<body>

<form action="/addplaylistname" method="post" enctype="multipart/form-data">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-whitefont-bold py-2 px-4 rounded">create new playlist name</button>
</form>

<form action="/addplaylist" method="post">
<div class="space-y-12">

<!--            adding to playlist -->
                <div class="border-b border-gray-900/10 pb-8">
                    <div class="mt-3 grid grid-cols-1 gap-x-5 gap-y-5 sm:grid-cols-4">
                    </div>

                    <div class="mt-5 flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                        <?php foreach ($oneplaylist as $oneplaylists): ?>
                        <input name ="playlist_id" value="<?=$oneplaylists->id?>"  type="hidden">
                        <h2   class="text-base font-semibold leading-7 text-gray-900" >playlist for <?=$oneplaylists->playlistname?></h2>
                        <?php endforeach; ?>

                    </div>
                    <div>
                        <?php foreach ($songs as $song): ?>
                            <button name="projectId" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800" type ="submit" value="<?php echo $song->id?>"><?php echo $song->album_name?></button>
                        <?php endforeach; ?>
                    </div>

    </div>
</div>
<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-whitefont-bold py-2 px-4 rounded">add songs  to playlist</button>
</form>


</body>

</html>
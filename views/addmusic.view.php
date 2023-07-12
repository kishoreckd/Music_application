<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <title>AddMusic</title>
</head>

<body>

    <form action="/addmusic" method="post" enctype="multipart/form-data">
        <div class="space-y-12">
            <?php if(isset($_SESSION['songerror'])) :?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo ($_SESSION['songerror'])?></span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
  </span>
                </div>
            <?php endif;?>

            <div class="border-b border-gray-900/10 pb-8">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Add Music</h2>
                <div class="mt-3 grid grid-cols-1 gap-x-5 gap-y-5 sm:grid-cols-4">
                    <div class="sm:col-span-4">
                        <label for="musicName" class="block text-sm font-medium leading-6 text-gray-900">Music
                            Name</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" name="musicName" id="musicName" autocomplete="username"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="Vaathi coming">
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="artistName" class="block text-sm font-medium leading-6 text-gray-900">Artist Name</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <select name="artist" id="cars">
                                    <option value="">select</option>

                                    <?php foreach ($artistname as $artist): ?>
                                    <option value="<?php echo$artist->id?>"><?php echo$artist->artist_name?></option>
                                    <?php endforeach;?>
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="col-span">
                        <label for="song-photo" class="block text-sm font-medium leading-6 text-gray-900">song
                            photo</label>
                        <div
                            class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                    <label for="file-upload"
                                           class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Upload a file</span>
                                        <input type="file" id="file-upload" name ="music"  multiple ="multiple">
                                    </label>
                                </div>
                                <p class="text-xs leading-5 text-gray-600">only JPG</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-whitefont-bold py-2 px-4 rounded">add Music</button>


        </div>


    </form>


</body>

</html>
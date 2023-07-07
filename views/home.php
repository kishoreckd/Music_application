<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <title>Music</title>
</head>

<body>
    
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                                alt="Your Company">
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="/"
                                    class="<?=url('/')?'bg-gray-900 text-white':'text-gray-300'?> rounded-md px-3 py-2 text-sm font-medium"
                                    aria-current="page">HomePage</a>
                                <form action="/addmusic" method="post" enctype="multipart/form-data">
                                    <button type="submit"
                                       class="<?=url('/team')?'bg-gray-900 text-white':'text-gray-300'?> hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Add Music</button>
                                </form>

                                <a href="/notes"
                                    class="<?=url('/notes')?'bg-gray-900 text-white':'text-gray-300'?> hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">My
                                    Notes</a>
                                <a href="/contact"
                                    class="<?=url('/contact')?'bg-gray-900 text-white':'text-gray-300'?> hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Contact
                                    Us</a>

                            </div>
                        </div>
                    </div>
                    
                   
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">


                            <!-- Log in -->
                            <?php if (isset($_SESSION['name'])) :?>
                            <p><?php echo $_SESSION['name']?></p>
                                <form action="/logout" method="post" enctype="multipart/form-data">
                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-whitefont-bold py-2 px-4 rounded">
                                        Log out</button>
                                </form>

                            <?php else : ?>

                                <div class="relative ml-3">
                                <div>
                                    <form action="/login" method="post" enctype="multipart/form-data">
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-whitefont-bold py-2 px-4 rounded">
                                            Log in</button>
                                    </form>

                                </div>

                            </div>
                            <?php endif; ?>

                        </div>

                    </div>

                </div>

                <!-- Mobile menu, show/hide based on menu state. -->
        </nav>
        <main>
        <header class="bg-white shadow">
                        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                            </h1>

                        </div>
                    </header>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <!-- Your content -->
            </div>
        </main>
    </div>


</body>

</html>
<!--<h2>This is home Page</h2>-->
<?php  require "views/partial/footer.php"?>
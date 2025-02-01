<!-- Main Header Section: With Mega Menu -->
<div
    class="relative overflow-hidden bg-white dark:bg-gray-900 dark:text-gray-100">
    <!-- Header -->
    <header
        x-data="{ mobileNavOpen: false }"
        id="page-header"
        class="relative flex flex-none items-center py-8">
        <!-- Main Header Content -->
        <div
            class="relative container mx-auto flex items-center justify-between px-4 lg:px-8 xl:max-w-7xl">
            <!-- Left Section -->
            <div class="flex items-center gap-4">
                <!-- Logo -->
                <a
                    href="javascript:void(0)"
                    class="group inline-flex items-center gap-2 text-lg font-bold tracking-wide text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300">
                    <svg
                        class="hi-mini hi-cube-transparent inline-block size-5 text-indigo-600 transition group-hover:scale-110 dark:text-indigo-400"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M9.638 1.093a.75.75 0 01.724 0l2 1.104a.75.75 0 11-.724 1.313L10 2.607l-1.638.903a.75.75 0 11-.724-1.313l2-1.104zM5.403 4.287a.75.75 0 01-.295 1.019l-.805.444.805.444a.75.75 0 01-.724 1.314L3.5 7.02v.73a.75.75 0 01-1.5 0v-2a.75.75 0 01.388-.657l1.996-1.1a.75.75 0 011.019.294zm9.194 0a.75.75 0 011.02-.295l1.995 1.101A.75.75 0 0118 5.75v2a.75.75 0 01-1.5 0v-.73l-.884.488a.75.75 0 11-.724-1.314l.806-.444-.806-.444a.75.75 0 01-.295-1.02zM7.343 8.284a.75.75 0 011.02-.294L10 8.893l1.638-.903a.75.75 0 11.724 1.313l-1.612.89v1.557a.75.75 0 01-1.5 0v-1.557l-1.612-.89a.75.75 0 01-.295-1.019zM2.75 11.5a.75.75 0 01.75.75v1.557l1.608.887a.75.75 0 01-.724 1.314l-1.996-1.101A.75.75 0 012 14.25v-2a.75.75 0 01.75-.75zm14.5 0a.75.75 0 01.75.75v2a.75.75 0 01-.388.657l-1.996 1.1a.75.75 0 11-.724-1.313l1.608-.887V12.25a.75.75 0 01.75-.75zm-7.25 4a.75.75 0 01.75.75v.73l.888-.49a.75.75 0 01.724 1.313l-2 1.104a.75.75 0 01-.724 0l-2-1.104a.75.75 0 11.724-1.313l.888.49v-.73a.75.75 0 01.75-.75z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Company</span>
                </a>
                <!-- END Logo -->

                <!-- Mega Menu visible on large screens -->
                <ul class="mt-0.5 hidden items-center lg:flex">
                    <li
                        class="group [&:focus-within>div]:visible [&:focus-within>div>div]:scale-100 [&:focus-within>div>div]:opacity-100 [&:focus-within>div>div>div]:scale-100 [&:focus-within>div>div>div]:opacity-100">
                        <!-- Solutions Link -->
                        <a
                            href="javascript:void(0)"
                            class="inline-flex h-8 items-center gap-1 px-2.5 text-sm font-semibold text-gray-900 group-hover:text-indigo-600 dark:text-gray-100 dark:group-hover:text-indigo-400">
                            <span>Solutions</span>
                            <svg
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                                class="hi-solid hi-chevron-down inline-block size-4 opacity-50">
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <!-- END Solutions Link -->

                        <!-- Solutions Menu -->
                        <div
                            class="invisible absolute top-8 right-8 left-8 z-1 pt-8 group-hover:visible">
                            <div
                                class="origin-top scale-90 overflow-hidden rounded-lg bg-white opacity-0 ring-1 shadow-xl ring-black/5 transition duration-300 ease-out group-hover:scale-100 group-hover:opacity-100 dark:bg-gray-800 dark:ring-white/10">
                                <div
                                    class="grid scale-95 grid-cols-4 opacity-0 transition duration-500 ease-out group-hover:scale-100 group-hover:opacity-100">
                                    <div class="space-y-6 p-8">
                                        <h4
                                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                                            Products
                                        </h4>
                                        <nav class="flex flex-col gap-3">
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                HTML Editor
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                CSS Editor
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Website Builder
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Animations Pack
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                3D Web Studio
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Web Templates
                                            </a>
                                        </nav>
                                    </div>
                                    <div class="space-y-6 p-8">
                                        <h4
                                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                                            Features
                                        </h4>
                                        <nav class="flex flex-col gap-3">
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Overview
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Components
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Media Libraries
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Databases
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Auto Backups
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                24/7 Support
                                            </a>
                                        </nav>
                                    </div>
                                    <div
                                        class="col-span-2 space-y-6 bg-gray-50 p-8 dark:bg-gray-700/25">
                                        <h4
                                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                                            From the blog
                                        </h4>
                                        <div class="grid grid-cols-2 gap-4 xl:gap-8">
                                            <a
                                                href="javascript:void(0)"
                                                class="block space-y-3 text-sm font-semibold transition-opacity hover:text-indigo-600 hover:opacity-90 dark:hover:text-indigo-400">
                                                <img
                                                    src="https://cdn.tailkit.com/media/placeholders/photo-8pb7Hq539Zw-300x180.jpg"
                                                    class="rounded-lg"
                                                    alt="Preview Image" />
                                                <h4>
                                                    How to create the best web apps online with our app
                                                </h4>
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="block space-y-3 text-sm font-semibold transition-opacity hover:text-indigo-600 hover:opacity-90 dark:hover:text-indigo-400">
                                                <img
                                                    src="https://cdn.tailkit.com/media/placeholders/photo-TxXuh_hAFd8-300x180.jpg"
                                                    class="rounded-lg"
                                                    alt="Preview Image" />
                                                <h4>
                                                    Inspiring results from your first work week online
                                                </h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Solutions Menu -->
                    </li>
                    <li
                        class="group [&:focus-within>div]:visible [&:focus-within>div>div]:scale-100 [&:focus-within>div>div]:opacity-100 [&:focus-within>div>div>div]:scale-100 [&:focus-within>div>div>div]:opacity-100">
                        <!-- Developers Link -->
                        <a
                            href="javascript:void(0)"
                            class="inline-flex h-8 items-center gap-1 px-2.5 text-sm font-semibold text-gray-900 group-hover:text-indigo-600 dark:text-gray-100 dark:group-hover:text-indigo-400">
                            <span>Developers</span>
                            <svg
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                                class="hi-solid hi-chevron-down inline-block size-4 opacity-50">
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <!-- END Developers Link -->

                        <!-- Developers Menu -->
                        <div
                            class="invisible absolute top-8 right-8 left-8 z-1 pt-8 group-hover:visible">
                            <div
                                class="origin-top scale-90 overflow-hidden rounded-lg bg-white opacity-0 ring-1 shadow-xl ring-black/5 transition duration-300 ease-out group-hover:scale-100 group-hover:opacity-100 dark:bg-gray-800 dark:ring-white/10">
                                <div
                                    class="grid scale-95 grid-cols-4 opacity-0 transition duration-500 ease-out group-hover:scale-100 group-hover:opacity-100">
                                    <div class="space-y-6 p-8">
                                        <h4
                                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                                            Get Started
                                        </h4>
                                        <nav class="flex flex-col gap-3">
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Installation
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Configuration
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Structure
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Starter Kits
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Deployment
                                            </a>
                                        </nav>
                                    </div>
                                    <div class="space-y-6 p-8">
                                        <h4
                                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                                            The Basics
                                        </h4>
                                        <nav class="flex flex-col gap-3">
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Routing
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Middleware
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Controllers
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Responses
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Views
                                            </a>
                                        </nav>
                                    </div>
                                    <div class="space-y-6 p-8">
                                        <h4
                                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                                            Database
                                        </h4>
                                        <nav class="flex flex-col gap-3">
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Query Builder
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Pagination
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Migrations
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Seeding
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Redis
                                            </a>
                                        </nav>
                                    </div>
                                    <div class="space-y-6 bg-gray-50 p-8 dark:bg-gray-700/25">
                                        <h4
                                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                                            From the docs
                                        </h4>
                                        <a
                                            href="javascript:void(0)"
                                            class="block space-y-3 text-sm font-semibold transition-opacity hover:text-indigo-600 hover:opacity-90 dark:hover:text-indigo-400">
                                            <div
                                                class="flex h-32 items-center justify-center rounded-lg border border-gray-200 bg-white text-indigo-500 dark:border-gray-700/75 dark:bg-gray-900/50 dark:text-indigo-400">
                                                <svg
                                                    class="hi-mini hi-document-text inline-block size-10"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true">
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M4.5 2A1.5 1.5 0 003 3.5v13A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.5-1.5V7.621a1.5 1.5 0 00-.44-1.06l-4.12-4.122A1.5 1.5 0 0011.378 2H4.5zm2.25 8.5a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5zm0 3a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <h4>Get Started with ease</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Developers Menu -->
                    </li>
                    <li
                        class="group [&:focus-within>div]:visible [&:focus-within>div>div]:scale-100 [&:focus-within>div>div]:opacity-100 [&:focus-within>div>div>div]:scale-100 [&:focus-within>div>div>div]:opacity-100">
                        <!-- Resources Link -->
                        <a
                            href="javascript:void(0)"
                            class="inline-flex h-8 items-center gap-1 px-2.5 text-sm font-semibold text-gray-900 group-hover:text-indigo-600 dark:text-gray-100 dark:group-hover:text-indigo-400">
                            <span>Resources</span>
                            <svg
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                                class="hi-solid hi-chevron-down inline-block size-4 opacity-50">
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <!-- END Resources Link -->

                        <!-- Resources Menu -->
                        <div
                            class="invisible absolute top-8 right-8 left-8 z-1 pt-8 group-hover:visible">
                            <div
                                class="origin-top scale-90 overflow-hidden rounded-lg bg-white opacity-0 ring-1 shadow-xl ring-black/5 transition duration-300 ease-out group-hover:scale-100 group-hover:opacity-100 dark:bg-gray-800 dark:ring-white/10">
                                <div
                                    class="grid scale-95 grid-cols-4 opacity-0 transition duration-500 ease-out group-hover:scale-100 group-hover:opacity-100">
                                    <div class="space-y-6 p-8">
                                        <h4
                                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                                            Learn
                                        </h4>
                                        <nav class="flex flex-col gap-3">
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Resource Center
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Developer Docs
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                User Guides
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Starters
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Video Library
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                                Tutorials
                                            </a>
                                        </nav>
                                    </div>
                                    <div
                                        class="col-span-3 space-y-6 bg-gray-50 p-8 dark:bg-gray-700/25">
                                        <h4
                                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                                            From the blog
                                        </h4>
                                        <div class="grid grid-cols-3 gap-4 xl:gap-8">
                                            <a
                                                href="javascript:void(0)"
                                                class="block space-y-3 text-sm font-semibold transition-opacity hover:text-indigo-600 hover:opacity-90 dark:hover:text-indigo-400">
                                                <div
                                                    class="flex h-32 items-center justify-center rounded-lg border border-gray-200 bg-white text-emerald-500 dark:border-gray-700/75 dark:bg-gray-900/50 dark:text-emerald-400">
                                                    <svg
                                                        class="hi-mini hi-users inline-block size-10"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z" />
                                                    </svg>
                                                </div>
                                                <h4>
                                                    How to work with your colleagues on the same app
                                                </h4>
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="block space-y-3 text-sm font-semibold transition-opacity hover:text-indigo-600 hover:opacity-90 dark:hover:text-indigo-400">
                                                <div
                                                    class="flex h-32 items-center justify-center rounded-lg border border-gray-200 bg-white text-rose-500 dark:border-gray-700/75 dark:bg-gray-900/50 dark:text-rose-400">
                                                    <svg
                                                        class="hi-mini hi-command-line inline-block size-10"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                        aria-hidden="true">
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M3.25 3A2.25 2.25 0 001 5.25v9.5A2.25 2.25 0 003.25 17h13.5A2.25 2.25 0 0019 14.75v-9.5A2.25 2.25 0 0016.75 3H3.25zm.943 8.752a.75.75 0 01.055-1.06L6.128 9l-1.88-1.693a.75.75 0 111.004-1.114l2.5 2.25a.75.75 0 010 1.114l-2.5 2.25a.75.75 0 01-1.06-.055zM9.75 10.25a.75.75 0 000 1.5h2.5a.75.75 0 000-1.5h-2.5z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <h4>
                                                    Most popular tips and tricks to integration with APIs
                                                </h4>
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="block space-y-3 text-sm font-semibold transition-opacity hover:text-indigo-600 hover:opacity-90 dark:hover:text-indigo-400">
                                                <div
                                                    class="flex h-32 items-center justify-center rounded-lg border border-gray-200 bg-white text-orange-500 dark:border-gray-700/75 dark:bg-gray-900/50 dark:text-orange-400">
                                                    <svg
                                                        class="hi-mini hi-puzzle-piece inline-block size-10"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M12 4.467c0-.405.262-.75.559-1.027.276-.257.441-.584.441-.94 0-.828-.895-1.5-2-1.5s-2 .672-2 1.5c0 .362.171.694.456.953.29.265.544.6.544.994a.968.968 0 01-1.024.974 39.655 39.655 0 01-3.014-.306.75.75 0 00-.847.847c.14.993.242 1.999.306 3.014A.968.968 0 014.447 10c-.393 0-.729-.253-.994-.544C3.194 9.17 2.862 9 2.5 9 1.672 9 1 9.895 1 11s.672 2 1.5 2c.356 0 .683-.165.94-.441.276-.297.622-.559 1.027-.559a.997.997 0 011.004 1.03 39.747 39.747 0 01-.319 3.734.75.75 0 00.64.842c1.05.146 2.111.252 3.184.318A.97.97 0 0010 16.948c0-.394-.254-.73-.545-.995C9.171 15.693 9 15.362 9 15c0-.828.895-1.5 2-1.5s2 .672 2 1.5c0 .356-.165.683-.441.94-.297.276-.559.622-.559 1.027a.998.998 0 001.03 1.005c1.337-.05 2.659-.162 3.961-.337a.75.75 0 00.644-.644c.175-1.302.288-2.624.337-3.961A.998.998 0 0016.967 12c-.405 0-.75.262-1.027.559-.257.276-.584.441-.94.441-.828 0-1.5-.895-1.5-2s.672-2 1.5-2c.362 0 .694.17.953.455.265.291.601.545.995.545a.97.97 0 00.976-1.024 41.159 41.159 0 00-.318-3.184.75.75 0 00-.842-.64c-1.228.164-2.473.271-3.734.319A.997.997 0 0112 4.467z" />
                                                    </svg>
                                                </div>
                                                <h4>
                                                    How to put together the components to create your UI
                                                </h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Resources Menu -->
                    </li>
                    <li class="group">
                        <a
                            href="javascript:void(0)"
                            class="inline-flex h-8 items-center gap-1 px-2.5 text-sm font-semibold text-gray-900 group-hover:text-indigo-600 dark:text-gray-100 dark:group-hover:text-indigo-400">
                            <span>Pricing</span>
                        </a>
                    </li>
                </ul>
                <!-- END Mega Menu visible on large screens -->
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="flex items-center">
                <!-- Actions -->
                <div class="flex items-center justify-center gap-2">
                    <a
                        href="javascript:void(0)"
                        class="hidden items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm leading-5 font-semibold text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-xs focus:ring-3 focus:ring-gray-300/25 active:border-gray-200 active:shadow-none lg:inline-flex dark:border-gray-700 dark:bg-transparent dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700">
                        <span>Sign In</span>
                    </a>
                    <a
                        href="javascript:void(0)"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-indigo-700 bg-indigo-700 px-3 py-2 text-sm leading-5 font-semibold text-white hover:border-indigo-600 hover:bg-indigo-600 hover:text-white focus:ring-3 focus:ring-indigo-400/50 active:border-indigo-700 active:bg-indigo-700 dark:focus:ring-indigo-400/90">
                        <span>Get Access</span>
                        <svg
                            class="hi-mini hi-arrow-right hidden size-5 opacity-50 sm:inline-block"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true">
                            <path
                                fill-rule="evenodd"
                                d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <!-- END Actions -->

                <!-- Open Mobile Navigation -->
                <div class="ml-3 lg:hidden">
                    <button
                        x-on:click="mobileNavOpen = true"
                        type="button"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm leading-5 font-semibold text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-xs focus:ring-3 focus:ring-gray-300/25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-transparent dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700"
                        aria-controls="tkMobileNav">
                        <svg
                            class="hi-mini hi-bars-3 inline-block size-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true">
                            <path
                                fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10zm0 5.25a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <!-- END Open Mobile Navigation -->
            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Main Header Content -->

        <!-- Mobile Navigation -->
        <nav
            x-cloak
            x-show="mobileNavOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-50 translate-x-full"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-50 translate-x-full"
            id="tkMobileNav"
            class="fixed top-0 right-0 bottom-0 z-50 w-80 overflow-auto bg-white/95 shadow-lg lg:hidden dark:bg-gray-800/95"
            tabindex="-1"
            aria-labelledby="tkMobileNavLabel"
            x-bind:aria-modal="mobileNavOpen ? 'true' : null"
            x-bind:role="mobileNavOpen ? 'dialog' : null">
            <div class="flex items-center justify-between p-6">
                <!-- Logo -->
                <a
                    id="tkMobileNavLabel"
                    href="javascript:void(0)"
                    class="group inline-flex items-center gap-2 text-lg font-bold tracking-wide text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300">
                    <svg
                        class="hi-mini hi-cube-transparent inline-block size-5 text-indigo-600 transition group-hover:scale-110 dark:text-indigo-400"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M9.638 1.093a.75.75 0 01.724 0l2 1.104a.75.75 0 11-.724 1.313L10 2.607l-1.638.903a.75.75 0 11-.724-1.313l2-1.104zM5.403 4.287a.75.75 0 01-.295 1.019l-.805.444.805.444a.75.75 0 01-.724 1.314L3.5 7.02v.73a.75.75 0 01-1.5 0v-2a.75.75 0 01.388-.657l1.996-1.1a.75.75 0 011.019.294zm9.194 0a.75.75 0 011.02-.295l1.995 1.101A.75.75 0 0118 5.75v2a.75.75 0 01-1.5 0v-.73l-.884.488a.75.75 0 11-.724-1.314l.806-.444-.806-.444a.75.75 0 01-.295-1.02zM7.343 8.284a.75.75 0 011.02-.294L10 8.893l1.638-.903a.75.75 0 11.724 1.313l-1.612.89v1.557a.75.75 0 01-1.5 0v-1.557l-1.612-.89a.75.75 0 01-.295-1.019zM2.75 11.5a.75.75 0 01.75.75v1.557l1.608.887a.75.75 0 01-.724 1.314l-1.996-1.101A.75.75 0 012 14.25v-2a.75.75 0 01.75-.75zm14.5 0a.75.75 0 01.75.75v2a.75.75 0 01-.388.657l-1.996 1.1a.75.75 0 11-.724-1.313l1.608-.887V12.25a.75.75 0 01.75-.75zm-7.25 4a.75.75 0 01.75.75v.73l.888-.49a.75.75 0 01.724 1.313l-2 1.104a.75.75 0 01-.724 0l-2-1.104a.75.75 0 11.724-1.313l.888.49v-.73a.75.75 0 01.75-.75z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Company</span>
                </a>
                <!-- END Logo -->

                <!-- Close Mobile Navigation -->
                <button
                    x-on:click="mobileNavOpen = false"
                    type="button"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm leading-5 font-semibold text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-xs focus:ring-3 focus:ring-gray-300/25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700">
                    <svg
                        class="hi-mini hi-x-mark -mx-0.5 inline-block size-5"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true">
                        <path
                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </button>
                <!-- END Close Mobile Navigation -->
            </div>
            <div class="h-px bg-gray-200/75 dark:bg-gray-700/75"></div>
            <div class="flex flex-col gap-8 px-6 py-6">
                <div class="grid grid-cols-2 gap-6">
                    <h3 class="col-span-2 font-semibold">Solutions</h3>
                    <div class="space-y-2">
                        <h4
                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                            Products
                        </h4>
                        <nav class="flex flex-col gap-3">
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                HTML Editor
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                CSS Editor
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Website Builder
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Animations Pack
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                3D Web Studio
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Web Templates
                            </a>
                        </nav>
                    </div>
                    <div class="space-y-2">
                        <h4
                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                            Features
                        </h4>
                        <nav class="flex flex-col gap-3">
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Overview
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Components
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Media Libraries
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Databases
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Auto Backups
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                24/7 Support
                            </a>
                        </nav>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <h3 class="col-span-2 font-semibold">Developers</h3>
                    <div class="space-y-2">
                        <h4
                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                            Get Started
                        </h4>
                        <nav class="flex flex-col gap-3">
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Installation
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Configuration
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Structure
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Starter Kits
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Deployment
                            </a>
                        </nav>
                    </div>
                    <div class="space-y-2">
                        <h4
                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                            The Basics
                        </h4>
                        <nav class="flex flex-col gap-3">
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Routing
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Middleware
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Controllers
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Responses
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Views
                            </a>
                        </nav>
                    </div>
                    <div class="col-span-2 space-y-2">
                        <h4
                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                            Database
                        </h4>
                        <nav class="flex flex-col gap-3">
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Query Builder
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Pagination
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Migrations
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Seeding
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Redis
                            </a>
                        </nav>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <h3 class="col-span-2 font-semibold">Resources</h3>
                    <div class="space-y-2">
                        <h4
                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                            Learn
                        </h4>
                        <nav class="flex flex-col gap-3">
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Resource Center
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Developer Docs
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                User Guides
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Starters
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Video Library
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Tutorials
                            </a>
                        </nav>
                    </div>
                    <div class="space-y-2">
                        <h4
                            class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
                            More
                        </h4>
                        <nav class="flex flex-col gap-3">
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Pricing
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Latest Posts
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Latest Tutorials
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="h-px bg-gray-200/75 dark:bg-gray-700/75"></div>
            <div class="flex flex-col gap-2 p-6">
                <a
                    href="javascript:void(0)"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm leading-5 font-semibold text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-xs focus:ring-3 focus:ring-gray-300/25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-transparent dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700">
                    <span>Sign In</span>
                </a>
                <a
                    href="javascript:void(0)"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-indigo-700 bg-indigo-700 px-3 py-2 text-sm leading-5 font-semibold text-white hover:border-indigo-600 hover:bg-indigo-600 hover:text-white focus:ring-3 focus:ring-indigo-400/50 active:border-indigo-700 active:bg-indigo-700 dark:focus:ring-indigo-400/90">
                    <span>Get Access</span>
                    <svg
                        class="hi-mini hi-arrow-right inline-block size-5 opacity-50"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </nav>
        <!-- END Mobile Navigation -->

        <!-- Mobile Navigation Backdrop -->
        <div
            x-cloak
            x-show="mobileNavOpen"
            x-on:click="mobileNavOpen = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-gray-900/20 backdrop-blur-xs will-change-auto lg:hidden dark:bg-gray-900/80"></div>
        <!-- END Mobile Navigation Backdrop -->
    </header>
    <!-- END Header -->

    <!--

  ADD YOUR HERO CONTENT BELOW

  -->

    <!-- Placeholder -->
    <div class="container mx-auto px-4 pb-12 lg:px-8 xl:max-w-7xl">
        <div
            class="flex items-center justify-center rounded-xl border-2 border-dashed border-gray-200 bg-gray-50 py-64 text-gray-400 dark:border-gray-700/75 dark:bg-gray-800/50">
            Hero Content
        </div>
    </div>

    <!--
  
  ADD YOUR HERO CONTENT ABOVE
  
  -->
</div>
<!-- END Main Header Section: With Mega Menu -->
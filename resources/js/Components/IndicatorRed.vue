<template>
<ul role="list" class="max-w-sm divide-y divide-gray-200 dark:divide-gray-700">
    <li class="py-3 sm:py-4">
        <div class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class=" items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-700 dark:text-red-50">
                <slot />
            </span>
        </div>
    </li>
</ul>
</template>
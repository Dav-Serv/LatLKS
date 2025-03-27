<template>
<ul role="list" class="max-w-sm divide-y divide-gray-200 dark:divide-gray-700">
    <li class="py-3 sm:py-4">
        <div class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-700 dark:text-green-50">
                <slot />
            </span>
        </div>
    </li>
</ul>
</template>
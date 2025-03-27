<template>
<ul role="list" class="max-w-sm divide-y divide-gray-200 ">
    <li class="py-3 sm:py-4">
        <div class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-500 dark:text-yellow-50">
                <slot />
            </span>
        </div>
    </li>
</ul>
</template>
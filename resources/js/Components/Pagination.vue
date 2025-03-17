<script setup >
import { Link } from '@inertiajs/vue3';

const props = defineProps({
	links: {
		type: Object,
		default: {}
	},
});

function isActive(link, key) {
	let cls = "";
	if(link.active == true) {
		cls = 'flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700';
	} else {
		cls = 'flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700';
		if(key == props?.links?.length - 1) {
			cls = 'flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700';
		} else if(key == 0) {
			cls = 'flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700';
		}
	}

	return cls;
}

function checkLink(link) {
	return  (link.url == null) ? "#" : link.url;
}
</script>

<template>
	<div v-if="links.length > 3">
		<nav class="py-7 flex justify-center">
			<ul class="inline-flex -space-x-px text-base h-10">
				<li v-for="(item, key) in links" :key="key" >
					<Link :href="checkLink(item)"
						:class="isActive(item, key)"
						v-html="item?.label"
					/>
				</li>
			</ul>
		</nav>
	</div>
</template>
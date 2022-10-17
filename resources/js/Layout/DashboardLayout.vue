<template>
	<Head title="Dashboard" />

	<div class="flex">
		<Sidenav />

		<div class="w-full ml-24 md:ml-44">
			<div v-if="props.errors" class="px-6">
				<div
					v-for="(error, index, a) in props.errors"
					:key="index"
					class="alert alert-error shadow-lg z-50 mt-4"
				>
					<div>
						<svg
							xmlns="http://www.w3.org/2000/svg"
							class="stroke-current flex-shrink-0 h-6 w-6"
							fill="none"
							viewBox="0 0 24 24"
						>
							<path
								stroke-linecap="round"
								stroke-linejoin="round"
								stroke-width="2"
								d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
							/>
						</svg>
						<span>{{ error }}</span>
					</div>
				</div>
			</div>
			<slot />
		</div>
	</div>
</template>

<script setup>
import Sidenav from "@/Components/Navbar.vue";
import { Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
	errors: Object,
});
</script>

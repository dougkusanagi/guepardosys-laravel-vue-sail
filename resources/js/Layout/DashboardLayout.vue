<template>
	<Head title="Dashboard" />

	<div class="flex">
		<Sidenav />

		<div class="w-full ml-24 md:ml-44">
			<slot />
		</div>
	</div>
</template>

<script setup>
import Sidenav from "@/Components/Navbar.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>

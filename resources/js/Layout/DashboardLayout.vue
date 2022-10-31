<template>
	<Head title="Dashboard" />

	<div class="flex">
		<Sidenav />

		<main class="w-full ml-24 md:ml-44">
			<Teleport to="body">
				<AlertsVue />
			</Teleport>
			<slot />
		</main>
	</div>
</template>

<script setup>
import Sidenav from "@/Components/Navbar.vue";
import { Head } from "@inertiajs/inertia-vue3";
import AlertsVue from "@/Components/Alerts.vue";
</script>

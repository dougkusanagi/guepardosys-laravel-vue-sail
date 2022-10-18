<template>
	<Head title="Dashboard" />

	<div class="flex">
		<Sidenav />

		<div class="w-full ml-24 md:ml-44">
			<div class="px-6">
				<AlertComponent
					variant="error"
					v-if="errors"
					v-for="error in errors"
					:message="error"
				/>

				<AlertComponent
					variant="success"
					v-if="flash.success"
					:title="flash.success.title"
					:message="flash.success.message"
				/>

				<AlertComponent
					variant="error"
					v-if="flash.error"
					:title="flash.error.title"
					:message="flash.error.message"
				/>

				<AlertComponent
					variant="warning"
					v-if="flash.warning"
					:title="flash.warning.title"
					:message="flash.warning.message"
				/>

				<AlertComponent
					variant="info"
					v-if="flash.info"
					:title="flash.info.title"
					:message="flash.info.message"
				/>
			</div>
			<slot />
		</div>
	</div>
</template>

<script setup>
import Sidenav from "@/Components/Navbar.vue";
import { Head } from "@inertiajs/inertia-vue3";
import AlertComponent from "@/Components/AlertComponent.vue";

const props = defineProps({
	errors: Object,
	flash: Object,
});
</script>

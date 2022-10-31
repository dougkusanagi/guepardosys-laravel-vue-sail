<template>
	<Transition
		enter-from-class="transition duration-1000 opacity-0"
		enter-top-class="transition duration-1000 opacity-100"
	>
		<div
			v-if="alerts.length"
			class="fixed flex flex-col justify-end bottom-0 right-0 px-6 py-4 overflow-y-auto"
		>
			<AlertComponent
				v-for="alert in alerts"
				:key="alert.id"
				:variant="alert.type"
				:title="alert.title"
				:message="alert.message"
			/>
		</div>
	</Transition>
</template>

<script setup>
import AlertComponent from "@/Components/AlertComponent.vue";
import { watch } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "@vue/reactivity";
import useAlerts from "@/Composables/useAlerts";

const { alerts, addAlert } = useAlerts();

// const showInitialAlerts = () => {
// 	const initial_alerts = usePage().props.value.flash.alert;

// 	if (initial_alerts) {
// 		initial_alerts.forEach((alert) => addAlert(alert));
// 	}
// };
// showInitialAlerts();

const alert = computed(() => {
	// console.log(usePage().props.value.flash.alert);
	return usePage().props.value.flash.alert;
});

watch(alert, (new_alert) => {
	if (!new_alert) return;

	if (new_alert instanceof Array) {
		new_alert.forEach((alert) => addAlert(alert));
		return;
	}

	addAlert(new_alert);
});
</script>

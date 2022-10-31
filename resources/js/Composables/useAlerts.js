import { ref } from "vue";
import { v4 as uuidv4 } from "uuid";

const alerts = ref([]);

export default function useAlerts() {
	const removeAlert = (id) => {
		alerts.value = alerts.value.filter((alert) => alert.id !== id);
	};

	const waitAndRemoveAlert = (id, delay = 4000) => {
		setTimeout(() => removeAlert(id), delay);
	};

	const addAlert = (alert) => {
		const id = uuidv4();

		alerts.value.push({
			id: id,
			...alert,
		});

		waitAndRemoveAlert(id);

		if (alerts.value.length > 5) {
			alerts.value = alerts.value.slice(1);
		}
	};

	return {
		alerts,
		addAlert,
		removeAlert,
	};
}

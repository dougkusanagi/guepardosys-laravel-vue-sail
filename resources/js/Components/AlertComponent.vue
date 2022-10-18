<template>
	<div class="alert shadow-lg z-50 mt-3" :class="`alert-${variant}`">
		<div>
			<component :is="icon" />
			<div>
				<h3 class="font-bold" v-text="title"></h3>

				<div class="text-xs" v-if="message" v-text="message"></div>
			</div>
		</div>
	</div>
</template>

<script setup>
import { computed } from "vue";
import XCircle from "@/Icons/XCircle.vue";
import CheckCircle from "@/Icons/CheckCircle.vue";

const props = defineProps({
	variant: {
		type: String,
		default: "success",
	},
	title: {
		type: String,
		default: "",
	},
	message: {
		type: String,
		default: "",
	},
});

// for this
const icon_list = { success: CheckCircle, error: XCircle };
const icon = computed(() => icon_list[props.variant]);
</script>

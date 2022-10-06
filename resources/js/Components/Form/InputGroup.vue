<template>
	<label>
		<span class="block text-slate-500 font-bold mb-2" v-if="label.length">
			{{ label }}
		</span>

		<div class="form-control">
			<div class="input-group">
				<input
					type="text"
					placeholder="Search…"
					class="w-full input input-bordered placeholder-gray-400"
				/>

				<slot />
			</div>
		</div>
	</label>
</template>

<script setup>
import Refresh from "../../Icons/Refresh.vue";
const props = defineProps({
	autocomplete: { type: String, default: "on" }, // on|off
	autofocus: Boolean,
	classes: { type: String, default: "" },
	disabled: Boolean,
	id: { type: String, default: "" },
	label: { type: String, default: "" },
	step: [String, Number],
	max: [String, Number],
	maxlength: [String, Number],
	min: [String, Number],
	minlength: [String, Number],
	modelValue: String,
	name: { type: String, default: "" },
	placeholder: { type: String, default: "" },
	readonly: Boolean,
	required: Boolean,
	type: String,
	variant: {
		type: String,
		default: "",
		validator(value) {
			// The value must match one of these strings
			return ["", "success", "danger"].includes(value);
		},
	},
});
</script>

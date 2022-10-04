<template>
	<div class="form-control">
		<div class="input-group">
			<select class="select select-bordered">
				<option disabled selected>Pick category</option>
				<option>T-shirts</option>
				<option>Mugs</option>
			</select>
			<button class="btn">Go</button>
		</div>
	</div>
</template>

<script setup>
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

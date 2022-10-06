<template>
	<label>
		<span class="block text-slate-500 font-bold mb-2" v-if="label.length">{{
			label
		}}</span>

		<input
			class="block w-full border bg-white px-3 py-2 transition duration-100 ease-in-out rounded-lg shadow-sm focus:ring-2 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed h-12"
			:class="
				(classes,
				{
					'text-slate-700 placeholder-gray-400 border-gray-300 focus:ring-indigo-600 focus:border-indigo-600':
						!variant.length,
					'text-emerald-700 placeholder-emerald-400 border-emerald-300 focus:ring-emerald-600 focus:border-emerald-600':
						variant === 'success',
					'text-rose-700 placeholder-rose-400 border-rose-300 focus:ring-rose-600 focus:border-rose-600':
						variant === 'danger',
				})
			"
			@input="e => $emit('update:modelValue', e.target.value)"
			@change="e => $emit('change:modelValue', e.target.value)"
			@focus="$emit('focus')"
			@blur="$emit('blur')"
			@keyup="$emit('keyup')"
			@keydown="$emit('keydown')"
			:value="modelValue"
      :id="id"
      :name="name"
      :step="step"
      :max="max"
      :maxlength="maxlength"
      :min="min"
      :minlength="minlength"
			:placeholder="placeholder"
			:disabled="disabled"
			:readonly="readonly"
			:required="required"
      :type="type"
      :autocomplete="autocomplete"
		/>
	</label>
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

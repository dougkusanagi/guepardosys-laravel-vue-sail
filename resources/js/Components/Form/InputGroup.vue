<template>
	<label>
		<span class="block text-slate-400 mb-2" v-if="label.length">{{
			label
		}}</span>

		<div class="form-control">
			<div class="input-group">
				<input
					type="text"
					placeholder="Search…"
					class="input input-bordered"
				/>
				
				<button class="btn">
					<svg
						xmlns="http://www.w3.org/2000/svg"
						class="h-6 w-6"
						fill="none"
						viewBox="0 0 24 24"
						stroke="currentColor"
					>
						<path
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
						/>
					</svg>
				</button>
			</div>
		</div>
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

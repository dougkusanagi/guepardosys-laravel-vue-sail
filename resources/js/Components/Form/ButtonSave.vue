<template>
	<LayoutButton type="submit" tag="button">
		<template #before><SaveIcon /></template>
		Salvar
	</LayoutButton>
</template>

<script setup>
import SaveIcon from "@/Icons/Save.vue";
import LayoutButton from "../LayoutButton.vue";
</script>

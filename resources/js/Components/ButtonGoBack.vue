<template>
	<LayoutButton @click.prevent="goBack" outline>
		<template #before>
			<ChevronLeft />
		</template>

		<span class="dark:text-white">Voltar</span>
	</LayoutButton>
</template>

<script setup>
import ChevronLeft from "@/Icons/ChevronLeft.vue";
import LayoutButton from "./LayoutButton.vue";

const goBack = () => window.history.back();
</script>

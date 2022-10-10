<template>
	<a
		type="submit"
		@click.prevent="goBack"
		class="btn btn-primary btn-outline font-normal text-xs gap-2 border-2"
	>
		<ChevronLeft class="-ml-2" />
		<span class="dark:text-white">Voltar</span>
	</a>
</template>

<script setup>
import ChevronLeft from "@/Icons/ChevronLeft.vue";

const goBack = () => window.history.back();
</script>

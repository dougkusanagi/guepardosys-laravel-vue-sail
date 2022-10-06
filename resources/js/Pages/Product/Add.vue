<template>
	<div class="pt-12 px-6">
		<div class="flex mb-2">
			<Breadcrumb :items="breadcrumbs" />
		</div>

		<h1 class="font-bold text-3xl mb-6">Cadastro de Produto</h1>

		<div class="flex space-x-6">
			<div
				class="w-80 h-max hidden flex-col lg:flex rounded-lg space-y-1 sticky top-0"
			>
				<a href="#info" class="btn btn-primary gap-2 justify-start">
					<InformationCircleIcon class="h-5 w-5" />

					<span class="text-white font-normal text-xs">Informações</span>
				</a>

				<a href="#image" class="btn btn-primary gap-2 justify-start">
					<PhotoIcon class="h-5 w-5" />

					<span class="text-white font-normal text-xs">Imagens</span>
				</a>
			</div>

			<div class="w-full">
				<div id="info" class="bg-white rounded-lg p-4 mb-6">
					<h2 class="text-xl font-bold mb-6">Informações</h2>

					<div class="md:flex mb-4 md:space-x-4">
						<div class="w-full md:w-1/2">
							<input-text
								label="Nome do Produto"
								placeholder="ex: Cartão de visitas"
								name="name"
								v-model="data.productName"
								v-focus
							/>
						</div>

						<div class="w-full md:w-1/2">
							<input-text
								label="Slug"
								placeholder="ex: cartao-de-visitas"
								name="slug"
								v-model="slug"
							/>
						</div>
					</div>

					<div class="md:flex md:space-x-4">
						<div class="w-full md:w-1/2">
							<input-text
								label="Preço"
								type="number"
								placeholder="ex: 19.98"
								name="price"
								min="0"
								step="0.01"
							/>
						</div>

						<div class="w-full md:w-1/2">
							<input-group label="Modelo" />
						</div>
					</div>
				</div>

				<div id="image" class="bg-white rounded-lg p-4 mb-6">
					<h2 class="text-xl font-bold mb-6">Imagens</h2>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
import InputText from "@/Components/Form/InputText.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import PhotoIcon from "@/Icons/Camera.vue";
import InformationCircleIcon from "@/Icons/InformationCircle.vue";
import { reactive, computed } from "vue";
import { slugfy } from "@/helpers/string";
import InputGroup from "@/Components/Form/InputGroup.vue";

const breadcrumbs = [
	{
		label: "Dashboard",
		link: route("dashboard"),
		isHome: true,
	},
	{
		label: "Produtos",
		link: route("product.index", {
			orderByField: "name",
			direction: "asc",
		}),
	},
	{
		label: "Cadastro",
	},
];

const data = reactive({ productName: "" });

const slug = computed(() => slugfy(data.productName));
</script>

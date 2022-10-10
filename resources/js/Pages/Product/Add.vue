<template>
	<div class="pt-12 px-6">
		<LayoutHeader :breadcrumbs-links="breadcrumbsLinks">
			<template #header-title>Cadastro de Produto</template>

			<template #append>
				<div class="flex justify-between md:flex-1 md:justify-end">
					<ButtonGoBack />
					<ButtonSave class="w-52 flex lg:hidden ml-4" />
				</div>
			</template>
		</LayoutHeader>

		<div class="flex lg:space-x-6">
			<SidenavScrollto>
				<ButtonSave />

				<SidenavScrolltoLink
					v-for="link in sidenavScrolltoLinks"
					:link="link"
					:key="link.route"
				/>
			</SidenavScrollto>

			<div class="w-full">
				<LayoutSection id="card-images">
					<template #header>Imagens</template>
				</LayoutSection>

				<LayoutSection id="card-basic-info">
					<template #header>Informações</template>

					<div class="md:flex md:space-x-4 mb-4">
						<div class="w-full md:w-1/2">
							<FormLabel for="name">Nome do Produto</FormLabel>

							<FormInputText
								placeholder="ex: Cartão de visitas"
								name="name"
								id="name"
								type="search"
								v-model="data.productName"
							/>
						</div>

						<div class="w-full md:w-1/2">
							<FormLabel for="slug">Slug</FormLabel>

							<FormInputText
								placeholder="ex: cartao-de-visitas"
								name="slug"
								id="slug"
								type="search"
								v-model="slug"
							/>
						</div>
					</div>

					<div class="md:flex md:space-x-4 mb-4">
						<div class="w-full md:w-1/3">
							<FormLabel for="price">Preço</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 19.98"
								name="price"
								id="price"
								min="0"
								step="0.01"
							/>
						</div>

						<div class="w-full md:w-1/3">
							<FormLabel for="model">Modelo</FormLabel>

							<FormSelect id="model" :options="product_model_prefixes" />
						</div>

						<div class="w-full md:w-1/3">
							<FormLabel for="status">Status</FormLabel>

							<FormSelect id="status" :options="product_status_enum" />
						</div>
					</div>

					<div class="md:flex md:space-x-4 mb-4">
						<div class="w-full md:w-1/3">
							<FormLabel for="stock_local">Estoque Local</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 19.98"
								name="stock_local"
								id="stock_local"
								min="0"
							/>
						</div>

						<div class="w-full md:w-1/3">
							<FormLabel for="stock_local_min">Estoque Local Mín.</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 19.98"
								name="stock_local_min"
								id="stock_local_min"
								min="0"
							/>
						</div>

						<div class="w-full md:w-1/3">
							<FormLabel for="stock_virtual">Estoque Virtual</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 19.98"
								name="stock_virtual"
								id="stock_virtual"
								min="0"
							/>
						</div>
					</div>

					<div class="md:flex md:space-x-4 mb-4">
						<div class="w-full md:w-1/2">
							<div class="form-control">
								<FormLabel for="description">Descrição Simples</FormLabel>

								<FormTextarea
									placeholder="Descrição Simples"
									name="description"
									id="description"
								/>
							</div>
						</div>

						<div class="w-full md:w-1/2">
							<div class="form-control">
								<FormLabel for="description_html">Descrição HTML</FormLabel>

								<FormTextarea
									placeholder="Descrição Simples"
									name="description_html"
									id="description_html"
								/>
							</div>
						</div>
					</div>
				</LayoutSection>

				<LayoutSection id="card-sizes">
					<template #header>Medidas</template>

					<div class="md:flex md:space-x-4 mb-4">
						<div class="w-full lg:w-1/4">
							<FormLabel for="width">Largura (cm)</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 19.98"
								name="width"
								id="width"
								min="0"
								step="0.01"
							/>
						</div>

						<div class="w-full lg:w-1/4">
							<FormLabel for="height">Altura (cm)</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 19.98"
								name="height"
								id="height"
								min="0"
								step="0.01"
							/>
						</div>

						<div class="w-full lg:w-1/4">
							<FormLabel for="length">Comprimento (cm)</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 19.98"
								name="length"
								id="length"
								min="0"
								step="0.01"
							/>
						</div>

						<div class="w-full lg:w-1/4">
							<FormLabel for="weight">Peso (cm)</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 19.98"
								name="weight"
								id="weight"
								min="0"
								step="0.01"
							/>
						</div>
					</div>
				</LayoutSection>
			</div>
		</div>
	</div>
</template>

<script setup>
import { reactive, computed } from "vue";
import { slugfy } from "@/helpers/string";
import FormLabel from "@/Components/Form/FormLabel.vue";
import ButtonSave from "@/Components/Form/ButtonSave.vue";
import FormSelect from "@/Components/Form/FormSelect.vue";
import FormTextarea from "@/Components/Form/FormTextarea.vue";
import ButtonGoBack from "@/Components/ButtonGoBack.vue";
import LayoutHeader from "@/Components/LayoutHeader.vue";
import FormInputText from "@/Components/Form/FormInputText.vue";
import LayoutSection from "@/Components/LayoutSection.vue";
import SidenavScrollto from "@/Components/SidenavScrollto.vue";
import SidenavScrolltoLink from "@/Components/SidenavScrolltoLink.vue";
import InformationCircleIcon from "@/Icons/InformationCircle.vue";
import CameraIcon from "@/Icons/Camera.vue";
import ScaleIcon from "@/Icons/Scale.vue";

const breadcrumbsLinks = [
	{
		label: "Dashboard",
		link: route("dashboard"),
		isHome: true,
	},
	{
		label: "Produtos",
		link: route("product.index", {
			order_by_field: "name",
			direction: "asc",
		}),
	},
	{
		label: "Cadastro",
	},
];

const sidenavScrolltoLinks = [
	{
		name: "Imagens",
		route: "#card-images",
		icon: CameraIcon,
	},
	{
		name: "Informações",
		route: "#card-basic-info",
		icon: InformationCircleIcon,
	},
	{
		name: "Medidas",
		route: "#card-sizes",
		icon: ScaleIcon,
	},
];

defineProps({
	product_model_prefixes: Array,
	product_status_enum: Array,
});

const data = reactive({ productName: "" });

const slug = computed(() => slugfy(data.productName));
</script>

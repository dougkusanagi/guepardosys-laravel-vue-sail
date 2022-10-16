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

		<form @submit.prevent="submit" class="flex lg:space-x-6">
			<SidenavScrollto>
				<ButtonSave />
				<SidenavScrolltoLink
					v-for="link in sidenavScrolltoLinks"
					:link="link"
					:key="link.route"
				/>
			</SidenavScrollto>

			<div class="w-full">
				<LayoutSection id="section-images">
					<template #header>Imagens</template>
				</LayoutSection>

				<LayoutSection id="section-basic-info">
					<template #header>Informações</template>

					<div class="md:flex md:space-x-4 mb-4">
						<div class="w-full md:w-1/2">
							<FormLabel for="name">Nome</FormLabel>

							<FormInputText
								placeholder="ex: Cartão de visitas"
								id="name"
								type="text"
								v-model="data.name"
							/>
						</div>

						<div class="w-full md:w-1/2">
							<FormLabel for="slug">Slug</FormLabel>

							<FormInputText
								placeholder="ex: cartao-de-visitas"
								id="slug"
								type="text"
								v-model="data.slug"
							/>
						</div>
					</div>

					<div class="md:flex md:space-x-4 mb-4">
						<div class="w-full md:w-1/3">
							<FormLabel for="price">Preço</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 19.98"
								id="price"
								min="0"
								step="0.01"
								v-model="data.price"
							/>
						</div>

						<div class="w-full md:w-1/3">
							<FormLabel for="model">Modelo</FormLabel>

							<FormSelect id="model" v-model="data.model">
								<option
									v-for="option in product_model_prefixes"
									:value="option.id"
									:key="option.id"
								>
									{{ option.name }}
								</option>
							</FormSelect>
						</div>

						<div class="w-full md:w-1/3">
							<FormLabel for="status">Status</FormLabel>

							<FormSelect id="status" v-model="data.status">
								<option
									v-for="option in product_status_enum"
									:value="option.id"
									:key="option.id"
								>
									{{ option.name }}
								</option>
							</FormSelect>
						</div>
					</div>

					<div class="md:flex md:space-x-4 mb-4">
						<div class="w-full md:w-1/2">
							<FormLabel for="barcode">
								Código de Barras

								<span class="cursor-pointer ml-2" title="EAN-9 | EAN-13 | CODE39"
									><InfoCircle
								/></span>
							</FormLabel>

							<FormInputText
								placeholder="ex: 1876551881"
								id="barcode"
								type="number"
								v-model="data.barcode"
							/>
						</div>

						<div class="w-full md:w-1/2">
							<FormLabel for="ncm">NCM</FormLabel>

							<FormInputText
								placeholder="ex: 551881"
								id="ncm"
								type="number"
								v-model="data.ncm"
							/>
						</div>

						<div class="w-full md:w-1/2">
							<FormLabel for="availability">Disponibilidade (dias)</FormLabel>

							<FormInputText
								placeholder="ex: 3"
								id="availability"
								type="number"
								v-model="data.availability"
							/>
						</div>
					</div>

					<div class="md:flex md:space-x-4 mb-4">
						<div class="w-full md:w-1/2">
							<div class="form-control">
								<FormLabel for="description">Descrição Simples</FormLabel>

								<FormTextarea
									placeholder="Descrição simples"
									id="description"
									rows="3"
									v-model="data.description"
								/>
							</div>
						</div>

						<div class="w-full md:w-1/2">
							<div class="form-control">
								<FormLabel for="description_html">Descrição HTML</FormLabel>

								<FormTextarea
									placeholder="<p>Descrição HTML</p>"
									id="description_html"
									rows="3"
									v-model="data.description_html"
								/>
							</div>
						</div>
					</div>

					<div class="md:flex md:space-x-4 mb-4">
						<div class="w-full">
							<div class="form-control">
								<FormLabel for="keywords">Palavras chave</FormLabel>

								<FormTextarea
									placeholder="vermelho, arte, teste"
									id="keywords"
									rows="2"
									v-model="data.keywords"
								/>
							</div>
						</div>
					</div>
				</LayoutSection>

				<LayoutSection id="section-stock">
					<template #header>Estoque</template>

					<div class="md:flex md:space-x-4 mb-4">
						<div class="w-full md:w-1/3">
							<FormLabel for="stock_local">Estoque Local</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 30"
								id="stock_local"
								min="0"
								v-model="data.stock_local"
							/>
						</div>

						<div class="w-full md:w-1/3">
							<FormLabel for="stock_local_min">Estoque Local Mín.</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 10"
								id="stock_local_min"
								min="0"
								v-model="data.stock_local_min"
							/>
						</div>

						<div class="w-full md:w-1/3">
							<FormLabel for="stock_virtual">Estoque Virtual</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 80"
								id="stock_virtual"
								min="0"
								v-model="data.stock_virtual"
							/>
						</div>
					</div>
				</LayoutSection>

				<LayoutSection id="section-sizes">
					<template #header>Medidas</template>

					<div class="md:flex md:space-x-4 mb-4">
						<div class="w-full lg:w-1/4">
							<FormLabel for="width">Largura (cm)</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 12"
								id="width"
								min="0"
								step="0.01"
								v-model="data.width"
							/>
						</div>

						<div class="w-full lg:w-1/4">
							<FormLabel for="height">Altura (cm)</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 18"
								id="height"
								min="0"
								step="0.01"
								v-model="data.height"
							/>
						</div>

						<div class="w-full lg:w-1/4">
							<FormLabel for="length">Comprimento (cm)</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 6"
								id="length"
								min="0"
								step="0.01"
								v-model="data.length"
							/>
						</div>

						<div class="w-full lg:w-1/4">
							<FormLabel for="weight">Peso (g)</FormLabel>

							<FormInputText
								type="number"
								placeholder="ex: 678"
								id="weight"
								min="0"
								step="0.01"
								v-model="data.weight"
							/>
						</div>
					</div>
				</LayoutSection>
			</div>
		</form>
	</div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { reactive, watch, computed } from "vue";
import { slugfy } from "@/helpers/string";
import FormLabel from "@/Components/Form/FormLabel.vue";
import ButtonGoBack from "@/Components/ButtonGoBack.vue";
import LayoutHeader from "@/Components/LayoutHeader.vue";
import ButtonSave from "@/Components/Form/ButtonSave.vue";
import FormSelect from "@/Components/Form/FormSelect.vue";
import LayoutSection from "@/Components/LayoutSection.vue";
import FormTextarea from "@/Components/Form/FormTextarea.vue";
import SidenavScrollto from "@/Components/SidenavScrollto.vue";
import FormInputText from "@/Components/Form/FormInputText.vue";
import SidenavScrolltoLink from "@/Components/SidenavScrolltoLink.vue";
import ScaleIcon from "@/Icons/Scale.vue";
import CameraIcon from "@/Icons/Camera.vue";
import InfoCircle from "@/Icons/InfoCircle.vue";
import StackCircleIcon from "@/Icons/StackCircle.vue";
import InformationCircleIcon from "@/Icons/InformationCircle.vue";

const breadcrumbsLinks = [
	{
		label: "Dashboard",
		link: route("dashboard"),
		isHome: true,
	},
	{
		label: "Produtos",
		link: route("product.index", {
			order_by: "name",
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
		route: "#section-images",
		icon: CameraIcon,
	},
	{
		name: "Informações",
		route: "#section-basic-info",
		icon: InformationCircleIcon,
	},
	{
		name: "Estoque",
		route: "#section-stock",
		icon: StackCircleIcon,
	},
	{
		name: "Medidas",
		route: "#section-sizes",
		icon: ScaleIcon,
	},
];

defineProps({
	product_model_prefixes: Array,
	product_status_enum: Array,
});

const data = reactive({
	name: "",
	slug: "",
	price: "",
	description: "",
	availability: "",
	stock_local: "",
	stock_virtual: "",
	stock_local_min: "",
	description_html: "",
	barcode: "",
	ncm: "",
	weight: "",
	height: "",
	width: "",
	length: "",
	keywords: "",
	status: "",
	model: ""
});

watch(data, new_data => data.slug = slugfy(new_data.name));

function submit() {
	Inertia.post(route('product.store'), data);
}
</script>

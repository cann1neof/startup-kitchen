<template>
  <v-app>
    <v-app-bar 
		fixed
		app
		flat
		height="75px"
		color="#FFF"
	>	
		<v-toolbar-title>
			<v-img
				width="220px"
				height="55px"
				contain
				src="/logo.png"
			></v-img>
		</v-toolbar-title>

		<v-spacer></v-spacer>
		
		<v-list 
			class="d-flex justify-space-around"
			color="transparent"
			style="width: 50%;"
			nav
		>
			<v-list-item
				class="mb-0"
				nuxt
				to="/"
			>
				<v-list-item-title class="text-center title-text">
					ГЛАВНАЯ
				</v-list-item-title>
			</v-list-item>

			<v-list-item
				class="mb-0"
				nuxt
				to="/search"
			>
				<v-list-item-title class="text-center title-text">
					ПОИСК
				</v-list-item-title>
			</v-list-item>

			<v-list-item
				class="mb-0"
				nuxt
				to="/create"
			>
				<v-list-item-title class="text-center title-text">
					СОЗДАТЬ
				</v-list-item-title>
			</v-list-item>
		</v-list>

		<v-spacer></v-spacer>
		<v-sheet
			@click="$router.push('/profile')"
			width="40px"
			height="40px"
			color="#D6D6D6"
			class="d-inline-block ml-0 mr-2 my-0 img-container-circle"
			v-if="$store.getters.user"
		>
			<v-img
				width="100%"
				height="100%"
				contain	
				
				src="/default-account.png"
			></v-img>
		</v-sheet>
		
		<v-sheet
			@click="$router.push('/profile')" 
			color="transparent"
			class="d-inline-block mr-4"
			height="40px"
			v-if="$store.getters.user"
		>
			<div class="centered-line">
				{{$store.getters.user.username}}
			</div>
		</v-sheet>

    </v-app-bar>

    <v-content>
      <v-container fluid class="mx-0 my-0 py-0 px-0">
        <nuxt />
      </v-container>
    </v-content>

    <v-footer fixed app>
      <span>&copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script>
  export default {}

</script>

<style>
.title-text{
	font-size: 25px;
}

.subtitle-text{
	font-size: 15px;
}

.img-container-circle{
	border-radius: 50%;
}
.centered-line{
	line-height: 40px;
	height: 40px;
	white-space: nowrap;
}

.standart-background{
	background-color: #F2F2F2;
	width: 100vw;
	min-height: 90vh;
}

</style>
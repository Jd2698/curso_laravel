<template>
	<div ref="alertContainer" v-if="hasErrors" role="alert" class="alert alert-danger alert-dismissible fade show mx-2 my-2">
		<ul>
			<li v-for="(error, index) in errors" :key="index">
				{{ error }}
			</li>
		</ul>
		<button type="button" class="btn-close" @click="closeAlert" aria-label="Close"></button>
	</div>
</template>

<script>
	export default {
		props: ['errors'],
		computed: {
			hasErrors() {
				return Object.entries(this.errors).length > 0
			}
		},
		methods: {
			closeAlert() {
				this.$refs.alertContainer.style.display = 'none'
			}
		}
	}
</script>

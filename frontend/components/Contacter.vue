<template>
    <div>
        <v-card>
            <v-card-title>
                Контакты
            </v-card-title>
            <v-card-text>
                <div 
                    v-for="(each, index) in instance"
                    :key="index"
                >
                    <v-icon> mdi-{{each.contactType}} </v-icon> {{each.text}}
                </div>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
export default {
    props: {
        instance: {
            type: Array,
            required: true,
        }
    }
}
</script>

<style scoped>

</style>
<template>
    <div class="standart-background">
        <v-card
            width="40vw"
            class="mx-auto py-4 mb-4"
            flat
            color="#F2F2F2"
        >
            <v-card-title>
                Авторизация
                <v-spacer></v-spacer>
                <v-btn
                    nuxt
                    to="/register/"
                    color="primary"
                >
                    Регистрация
                </v-btn>
            </v-card-title>
            <v-card-text class="py-3">
                <v-card>
                    <v-card-text>
                        <v-form>
                            <v-text-field
                                outlined
                                label="E-Mail"
                                dense
                                :rules="emailRules"
                                v-model="email"
                            ></v-text-field>
                            <v-text-field
                                outlined
                                label="Пароль"
                                dense
                                :rules="passwordRules"
                                v-model="password"
                            ></v-text-field>
                        </v-form>
                        <div class="text-center full-width">
                            <v-btn
                                color="primary"
                                @click="login()"
                            >
                                Войти
                            </v-btn>
                        </div>
                    </v-card-text>
                </v-card>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
export default {
    middleware: 'anon',
    data: () => ({
        email: '',
        password: '',
    }),
    methods: {
        login(){
            this.$store.dispatch('login', {email: this.email, password: this.password}).then(r=>{
                document.location = '/'
            }).catch(err=>console.log(err))
        }
    },
    computed:{
        emailRules(){
            return [
                value => !!value || 'Это поле обязательно для заполнения',
                value => /.+@.+\..+/.test(value) || 'Неправильный email',
            ]
        },
        passwordRules(){
            return [
                value => !!value || 'Это поле обязательно для заполнения',
            ]
        },

    }
}
</script>

<style lang="scss" scoped>

</style>
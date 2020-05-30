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
                                label="ФИО"
                                dense
                                :rules="nameRules"
                                v-model="name"
                            ></v-text-field>
                            <v-text-field
                                outlined
                                label="E-Mail"
                                dense
                                :rules="emailRules"
                                v-model="email"
                            ></v-text-field>
                            <v-text-field
                                outlined
                                label="Логин"
                                dense
                                :rules="usernameRules"
                                v-model="username"
                            ></v-text-field>
                            <v-text-field
                                outlined
                                label="Пароль"
                                dense
                                :rules="passwordRules"
                                v-model="password"
                            ></v-text-field>
                            <v-text-field
                                outlined
                                label="Повторите пароль"
                                dense
                                :rules="passwordRules"
                                v-model="passwordConfirm"
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
    data: () => ({
        username: '',
        name: '',
        email: '',
        password: '',
        passwordConfirm: '',
    }),
    methods: {
        async login(){
            if(this.password === this.passwordConfirm){
                const data = {
                    username: this.username,
                    name: this.name,
                    email: this.email,
                    password: this.password
                }

                try{
                    const res = this.$store.dispatch('register', data)
                    await this.$store.dispatch('login', {email: this.email, password:this.password})
                    this.$router.push('/')
                } catch(err){
                    console.log(err)
                }
            }
        },
    },
    computed: {
        passwordRules(){
            return [
                v => !!v || 'Это поле обязательно для заполнения'
            ]
        },
        nameRules(){
            return [
                v => !!v || 'Это поле обязательно для заполнения'
            ]
        },
        usernameRules(){
            return [
                v => !!v || 'Это поле обязательно для заполнения'
            ]
        },
        emailRules(){
            return [
                v => !!v || 'Это поле обязательно для заполнения',
                v => /.+@.+\..+/.test(v) || 'Неправильный формат e-mail'
            ]
        }
    }
}
</script>

<style scoped>

</style>
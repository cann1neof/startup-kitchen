<template>
    <div class="standart-background">
        <v-card
            width="50vw"
            class="mx-auto py-4 mb-4"
            flat
            color="#F2F2F2"
        >
            <v-card-title>
                Создать новый проект
            </v-card-title>
            <v-card-text>
                <v-row>
                    <v-col cols=4>
                        <v-card>
                            <v-img
                                :src="fileUrl"
                            ></v-img>
                            <v-card-subtitle>
                                Выберите фото для вашего проекта
                            </v-card-subtitle>
                            <v-card-actions>
                                <v-file-input
                                    label="Выберите изображение"
                                    outlined
                                    @change="uploadImage"
                                >
                                </v-file-input>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                    <v-col cols=8>
                        <v-card>
                            <v-card-title>
                                <v-text-field
                                    v-model="title"
                                    outlined
                                    label="Заголовок"
                                >
                                </v-text-field>
                            </v-card-title>
                            <v-card-text>
                                <v-textarea
                                    v-model="text"
                                    outlined
                                    label="Расскажите о проекте"
                                ></v-textarea>
                                <v-chip-group>
                                    <v-chip
                                        v-for="(chip, index) in chips"
                                        :key="index"
                                        :color="chip.choosen ? 'primary' : ''"
                                        @click="chip.choosen = !chip.choosen"
                                    >
                                    {{chip.text}}
                                    </v-chip>
                                </v-chip-group>
                                
                                <v-menu
                                    v-model="menu"
                                    :close-on-content-click="false"
                                    :nudge-width="200"
                                    offset-y
                                    >
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            color="primary"
                                            v-on="on"
                                        >
                                        Выберите способ связи
                                        </v-btn>
                                    </template>

                                    <v-card width="600px">
                                        <v-card-title>
                                            Выберите способ связи
                                        </v-card-title>
                                        <v-card-text>
                                            <v-list v-if="contacts">
                                                <v-list-item
                                                    v-for="({contactType, text}, index) in contacts"
                                                    :key="index"
                                                >                    
                                                    <v-icon class="mr-1">mdi-{{contactType}}</v-icon> {{text}}
                                                    <v-spacer></v-spacer>
                                                    <v-icon @click="deleteContact(index)">mdi-delete</v-icon>
                                                </v-list-item>
                                            </v-list>

                                            <v-divider></v-divider>

                                            <v-row>
                                                <v-col cols=6>
                                                    <v-select
                                                        dense
                                                        outlined
                                                        :prepend-icon="contactTypeSelector ? `mdi-${contactTypeSelector}` : 'mdi-account-group'"
                                                        :items="['vk', 'telegram', 'email', 'facebook', 'twitter', 'discord', 'git', 'linkedin', 'instagram']"
                                                        v-model="contactTypeSelector"
                                                    ></v-select>
                                                </v-col>
                                                <v-col cols=6>
                                                    <v-text-field
                                                        dense
                                                        outlined
                                                        v-model="contactText"
                                                    ></v-text-field>
                                                </v-col>
                                            </v-row>
                                            <div class="text-center full-width">
                                                <v-btn @click="addNewContact">
                                                    Добавить
                                                </v-btn>
                                            </div>
                                        </v-card-text>
                                    </v-card>
                                </v-menu>
                            </v-card-text>

                            <v-card-actions>
                                <v-btn @click="saveProject" color="primary">
                                    Готово!
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>            
            </v-card-text>
        </v-card>
    </div>
</template>
<script>
export default {
    middleware: 'authenticated',
    data: () => ({
        fileUrl: '/default-photo.png',
        file: null,
        title: '',
        text: '',
        themes: [],
        contacts: [],
        contactTypeSelector: '',
        contactText: '',
        chips: [
            {text: 'THEME 1', choosen:false}, {text: 'THEME 2', choosen:false}, {text: 'THEME 3', choosen:false}, {text: 'THEME 4', choosen:false}
        ],
        menu: false,
    }),
    methods: {
        uploadImage(file){
            const u = file ? URL.createObjectURL(file) : '/default-photo.png'
            this.fileUrl = u
            this.file = file || null
        },
        saveProject(){
            const themes = JSON.stringify(this.chips.filter(el => el.choosen).map(el => el.text))
            const title = this.title
            const text = this.text
            const contacts = JSON.stringify(this.contacts)
            const outputData = { themes, title, text, contacts }
            this.$axios.post('', outputData).then(res => {
                if(res.status == 201 && res.data.id){
                    if (this.file){
                        const config = {
                            headers: {
                                'content-type': 'multipart/form-data'
                            }
                        }
                        let formData = new FormData()
                        formData.append('image', this.file)
                        this.$axios.post(`${res.data.id}`, formData, config ).then(res => console.log(res))
                    }
                }
            })
            .catch(err => console.log('rrr', err))
            
        },
        addNewContact(){
            if(this.contactTypeSelector && this.contactText){
                this.contacts.push({contactType: this.contactTypeSelector, text: this.contactText})
                this.contactTypeSelector = ''
                this.contactText = ''
            }
        }
    }
}
</script>

<style scoped>

</style>
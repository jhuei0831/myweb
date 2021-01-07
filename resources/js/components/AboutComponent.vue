<template>
    <v-layout>
        <v-flex>
            <v-card dark tile img="https://cdn.vuetifyjs.com/images/cards/server-room.jpg" class="mx-auto" width="800">
                <v-layout column align-center max-width="500">
                    <v-tooltip right>
                        <template v-slot:activator="{ on, attrs }">
                            <v-avatar size='100' class="my-3" v-bind="attrs" v-on="on">
                                <v-img :src="userdata.photo ? userdata.photo : 'https://cdn2.ettoday.net/images/1457/d1457772.jpg'" style="cursor: pointer" @click="$refs.FileInput.click()"></v-img>  
                                <input ref="FileInput" type="file" style="display: none;" @change="onFileSelect"/>
                            </v-avatar>
                        </template>
                        <span>點擊更換大頭貼</span>
                    </v-tooltip>
                </v-layout>
            </v-card>
            <v-dialog v-model="dialog">
                <v-card>
                    <v-card-title>圖片剪裁</v-card-title>
                    <v-card-text>
                        <VueCropper v-show="selectedFile" ref="cropper" :src="selectedFile" alt="Source Image"></VueCropper>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn class="primary" @click="saveImage(), (dialog = false)">保存</v-btn>
                        <v-btn color="primary" text @click="dialog = false">取消</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-card dark tile color="purple darken-4" class="mx-auto" width="800" :height="isEditing ? '280' : '200'">
                <v-toolbar flat color="purple">
                    <v-toolbar-title class="font-weight-light">
                        <v-icon>mdi-card-account-details</v-icon> User Profile
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn color="purple darken-3" fab small @click="isEditing = !isEditing">
                        <v-icon v-if="isEditing">mdi-close</v-icon>
                        <v-icon v-else>mdi-pencil</v-icon>
                    </v-btn>
                </v-toolbar>
                <v-layout column align-center class="mt-4 text-center">
                    <v-card-text class="headline py-1" v-show="!isEditing">{{ userdata.name }}</v-card-text>
                    <v-card-text class="pt-1 pb-4" v-show="!isEditing"><v-icon>mdi-email</v-icon> {{ userdata.email }}</v-card-text>  
                    <validation-observer ref="observer" v-slot="{ invalid }">
                        <v-form @submit.prevent="detail_submit" v-show="isEditing" ref="form_detail" lazy-validation>
                            <validation-provider v-slot="{errors}" name="名稱" rules="required|max:10">
                                <v-text-field name="name" label="名稱" v-model="userdata.name" :error-messages="errors"></v-text-field>         
                            </validation-provider>
                            <validation-provider v-slot="{errors}" name="電子信箱" rules="required|email">
                                <v-text-field name="email" label="信箱" v-model="userdata.email" :error-messages="errors"></v-text-field>  
                            </validation-provider>
                            <v-btn :disabled="invalid" color="purple lighten-2" @click="detail_submit">Save</v-btn>
                        </v-form>                         
                    </validation-observer> 
                </v-layout>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import VueCropper from 'vue-cropperjs'
import 'cropperjs/dist/cropper.css'
import Swal from 'sweetalert2'

export default {
    components: { VueCropper },
    data() {
        return{
            mime_type: '',
            cropedImage: '',
            autoCrop: false,
            selectedFile: '',
            image: '',
            dialog: false,
            files: '',
            isEditing: null,
        }
    },
    computed: {
        ...mapGetters("auth", ["userdata"])
    },
    methods: {
        ...mapActions("users", ["editSelf", "editPhoto"]),
        detail_submit() {
            if (this.$refs.form_detail.validate()) {
                let formContents = {name: this.userdata.name, email: this.userdata.email}
                let id = this.userdata.id
                this.editSelf({formContents, id})
                this.isEditing = false
            }
        },
        saveImage() {
            let id = this.userdata.id
            this.cropedImage = this.$refs.cropper.getCroppedCanvas().toDataURL()
            let formContents = {photo: this.cropedImage}
            if (this.cropedImage.length > 65536) {
                Swal.fire({
                    title: '圖片大小需小於64KB',
                    text: 'size : ' + this.cropedImage.length,
                    icon: 'error',
                    confirmButtonText: '好喔',
                })
            }
            else{
                this.editPhoto({formContents, id})
            } 
        },
        onFileSelect(e) {
            const file = e.target.files[0]
            this.mime_type = file.type
            // console.log(this.mime_type)
            // 判斷檔案格式
            if (this.mime_type != 'image/jpeg' &&　this.mime_type != 'image/png' && this.mime_type != 'image/jpg') {
                Swal.fire({
                    title: '只接受.jpg和.png格式',
                    text: 'type : ' + this.mime_type,
                    icon: 'error',
                    confirmButtonText: '好喔',
                })
            }
            else if (typeof FileReader === 'function') {
                this.dialog = true
                const reader = new FileReader()
                reader.onload = (event) => {
                    this.selectedFile = event.target.result
                    this.$refs.cropper.replace(this.selectedFile)
                }
                reader.readAsDataURL(file)
            } 
            else {
                alert('Sorry, FileReader API not supported')
            }
        },
    }
}
</script>

<template>
    <div>
        <div size="120" class="user">
            <v-img :src="userdata.photo" class="profile-img"></v-img>
            <v-icon class="icon primary white--text" @click="$refs.FileInput.click()">mdi-upload</v-icon>
            <input ref="FileInput" type="file" style="display: none;" @change="onFileSelect" />
            <h1>{{ userdata.id }}</h1>
        </div>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-text>
                    <VueCropper v-show="selectedFile" ref="cropper" :src="selectedFile" alt="Source Image"></VueCropper>
                </v-card-text>
                <v-card-actions>
                    <v-btn class="primary" @click="saveImage(), (dialog = false)">Crop</v-btn>
                    <v-btn color="primary" text @click="dialog = false">Cancel</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'
import VueCropper from 'vue-cropperjs'
import 'cropperjs/dist/cropper.css'
export default {
    components: { VueCropper },
    props: ['image_name'],
    data() {
        return {
            mime_type: '',
            cropedImage: '',
            autoCrop: false,
            selectedFile: '',
            image: '',
            dialog: false,
            files: '',
        }
    },
    computed: {
        ...mapGetters("auth", ["userdata"]),
    },
    methods: {
        saveImage() {
            const userId = this.userdata.id
            this.cropedImage = this.$refs.cropper.getCroppedCanvas().toDataURL()
            this.$refs.cropper.getCroppedCanvas().toBlob((blob) => {
                const formData = new FormData()
                formData.append('profile_photo', blob, 'name.jpeg')
                axios.put('/api/user-photo/'+userId , {'photo': this.$refs.cropper.getCroppedCanvas().toDataURL()})
                    .then((response) => {
                        console.log(response.data.message)
                        location.reload();
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            }, this.mime_type)
        },
        onFileSelect(e) {
            const file = e.target.files[0]
            this.mime_type = file.type
            console.log(this.mime_type)
            if (typeof FileReader === 'function') {
                this.dialog = true
                const reader = new FileReader()
                reader.onload = (event) => {
                    this.selectedFile = event.target.result
                    this.$refs.cropper.replace(this.selectedFile)
                }
                reader.readAsDataURL(file)
            } else {
                alert('Sorry, FileReader API not supported')
            }
        },
    },
}
</script>
<style scoped>
    .user {
        width: 140px;
        height: 140px;
        border-radius: 100%;
        border: 3px solid #2e7d32;
        position: relative;
    }
    .profile-img {
        height: 100%;
        width: 100%;
        border-radius: 50%;
    }
    .icon {
        position: absolute;
        top: 10px;
        right: 0;
        background: #e2e2e2;
        border-radius: 100%;
        width: 30px;
        height: 30px;
        line-height: 30px;
        vertical-align: middle;
        text-align: center;
        color: #0000ff;
        font-size: 14px;
        cursor: pointer;
    }
</style>
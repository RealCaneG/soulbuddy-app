<template>
    <div class="card mt-4" :key="componentKey">
        <div class="card-header">New Secret</div>
        <div class="card-body">
            <div
                v-if="status_msg"
                :class="{ 'alert-success': status, 'alert-danger': !status }"
                class="alert"
                role="alert"
            >{{ status_msg }}</div>
            <form>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input
                        v-model="title"
                        type="text"
                        class="form-control"
                        id="title"
                        placeholder="Secret Title"
                        required
                    />
                </div>
                <b-form-group
                    id="input-group-1"
                    label="Category"
                    label-for="input-1">
                    <b-form-select
                        id="input-1"
                        v-model="category"
                        :options="categories"
                        placeholder="Select a category"
                    ></b-form-select>
                </b-form-group>
                <div class="form-group">
                    <label for="secret-description">Secret Description</label>
                    <textarea placeholder="Describe what your secret is about." maxlength="100" v-model="description" class="form-control" id="secret-description" rows="2" required></textarea>
                    <label for="secret-description">100 characters max</label>
                </div>
                <div class="form-group">
                    <label for="secret-content">Secret Content</label>
                    <textarea placeholder="Only the users who unlock this secret will be about to see" v-model="body" class="form-control" id="secret-content" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Vouchers to Unlock</label>
                    <b-form-spinbutton id="price" v-model="price" min="1" max="25"></b-form-spinbutton>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button
                type="button"
                @click="createSecret"
                class="btn btn-success"
            >{{ isCreatingSecret ? "Posting..." : "Create Secret" }}</button>
        </div>
    </div>
</template>

<style>
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #409eff;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }
    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }
</style>

<script>
    import { setTimeout } from "timers";
    import { mapState, mapActions } from "vuex";
    export default {
        name: "create-secret",
        data() {
            return {
                dialogImageUrl: "",
                dialogVisible: false,
                imageList: [],
                status_msg: "",
                status: "",
                isCreatingSecret: false,
                title: "",
                description: "",
                price: 0,
                body: "",
                componentKey: 0,
                category: null,
                categories: this.$store.state.categories,
            };
        },
        computed: {},
        mounted() {},
        methods: {
            updateImageList(file) {
                this.imageList.push(file.raw);
            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.url;
                this.imageList.push(file);
                this.dialogVisible = true;
            },
            createSecret(e) {
                e.preventDefault();
                if (!this.validateForm()) {
                    return false;
                }
                const that = this;
                this.isCreatingSecret = true;
                let formData = new FormData();
                formData.append("title", this.title);
                formData.append("body", this.body);
                formData.append('description', this.description);
                formData.append("price", this.price);
                formData.append("categoryId", this.category);
                this.$emit('onSubmit', formData);
            },
            validateForm() {
                //no vaildation for images - it is needed
                if (!this.title) {
                    this.status = false;
                    this.showNotification("Secret title cannot be empty");
                    return false;
                }
                if (!this.body) {
                    this.status = false;
                    this.showNotification("Secret body cannot be empty");
                    return false;
                }
                if (!this.category) {
                    this.status = false;
                    this.showNotification("Please select a category");
                    return false;
                }
                return true;
            },
            showNotification(message) {
                this.status_msg = message;
                setTimeout(() => {
                    this.status_msg = "";
                }, 3000);
            }
        }
    };
</script>

<template>
    <div class="content">
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
            <b-form-group
                id="input-group-1"
                label="Request Category"
                label-for="input-1">
                <b-form-select
                    id="input-1"
                    v-model="form.category"
                    :options="allCategories"
                    required
                    placeholder="Enter email"
                ></b-form-select>
            </b-form-group>

            <b-form-group id="input-group-3" label="Expiry Date" label-for="input-date">
                <b-form-datepicker id="input-date" v-model="form.date" class="mb-2"></b-form-datepicker>
            </b-form-group>

            <b-form-group id="input-group-2" label="Subject" label-for="input-2">
                <b-form-input
                    id="input-2"
                    v-model="form.subject"
                    required
                    placeholder="Subject"
                ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-4" label="General Description" label-for="input-3">
                <b-form-textarea
                    id="input-3"
                    v-model="form.description"
                    placeholder="What is it about?"
                    rows="8"
                    size="lg"
                    required
                ></b-form-textarea>
            </b-form-group>
            <div class="flex justify-content-between">
                <b-button type="submit" variant="primary">Submit</b-button>
                <b-button type="reset" variant="danger">Reset</b-button>
            </div>
        </b-form>
    </div>
</template>

<script>
    export default {
        name: "CreateCounsellingRequest",
        props: ["allCategories"],
        data() {
            return {
                form: {
                    subject: '',
                    date: new Date().toISOString().slice(0, 10),
                    category: null,
                    description: ''
                },
                show: true
            }
        },
        methods: {
            onSubmit(evt) {
                evt.preventDefault()
                const formData = new FormData();
                formData.append('data', JSON.stringify(this.form));
                this.$emit('onSubmit', formData)
            },
            onReset(evt) {
                evt.preventDefault()
                // Reset our form values
                this.resetParam();
                // Trick to reset/clear native browser form validation state
                this.show = false
                this.$nextTick(() => {
                    this.show = true
                })
            },
            resetParam() {
                this.form.description = ''
                this.form.subject = ''
                this.form.category = null
                this.form.date = ''
            }
        }
    }
</script>

<style scoped>
    .label {
        font-family: Arvo, serif;
        font-size: 19px;
    }

    #input-1 {
        width: 10rem;
    }

    .b-form-btn-label-control.form-control {
        width: 20rem;
    }
</style>

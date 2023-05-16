import VueSweetalert2 from 'vue-sweetalert2';

import LoginComponent from './components/Login/Login.vue';
import ForgotPassword from './components/ForgotPassword/ForgotPassword.vue';
import ResetPassword from './components/ResetPassword/ResetPassword.vue';
import DeleteButton from './components/DeleteButton/DeleteButton.vue';
import SelectBranch from "./components/SelectBranch/SelectBranch.vue";
import SelectOrgBranch from "./components/SelectOrgBranch/SelectOrgBranch.vue";
import CpfCnpj from "./components/CpfCnpj/CpfCnpj.vue";
import ApproveBeerType from "./components/ApproveBeerType/ApproveBeerType.vue";
import MaintenanceForm from "./components/MaintenanceForm/MaintenanceForm.vue";
import Temperature from "./components/Temperature/Temperature.vue";
import TapList from "./components/TapList/TapList.vue";
import OutKegRegisterButton from "./components/OutKegRegisterButton/OutKegRegisterButton.vue";
import OutKegRegister from "./components/OutKegRegister/OutKegRegister.vue";
import ChangeKegTap from "./components/ChangeKegTap/ChangeKegTap.vue";
import AttrKegToTap from "./components/AttrKegToTap/AttrKegToTap.vue";
import Modal from "./components/Modal/Modal.vue";
import AddColdChamber from "./components/AddColdChamber/AddColdChamber.vue";
import EditColdChamber from "./components/EditColdChamber/EditColdChamber.vue";
import AsideColdChamberList from "./components/AsideColdChamberList/AsideColdChamberList.vue";
import RealeaseTap from "./components/RealeaseTap/RealeaseTap.vue";

Vue.use(VueSweetalert2);

new Vue({
    el: '#vueApp',

    components: {
        LoginComponent,
        ForgotPassword,
        ResetPassword,
        DeleteButton,
        SelectBranch,
        SelectOrgBranch,
        CpfCnpj,
        ApproveBeerType,
        MaintenanceForm,
        Temperature,
        TapList,
        OutKegRegister,
        OutKegRegisterButton,
        ChangeKegTap,
        AttrKegToTap,
        Modal,
        AddColdChamber,
        EditColdChamber,
        AsideColdChamberList,
        RealeaseTap
    },

    data: {
        title: '4BarSolutions'
    }
});

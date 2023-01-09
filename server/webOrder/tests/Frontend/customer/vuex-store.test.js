import { shallowMount, createLocalVue } from '@vue/test-utils'
import Vuex from 'vuex'
import CounterVuex from '@/components/CounterVuex'

const localVue = createLocalVue()
localVue.use(Vuex)

describe('addCartModal', () => {

    let store
    let countStoreMock
    let wrapper

})
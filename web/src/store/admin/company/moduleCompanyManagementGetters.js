
export default {
    getCompanyById: (state) => (id) => {
        return state.companies.find(company => company.id === id)
    }
}
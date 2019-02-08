// Views
const Welcome = () => import('../../components/public/Welcome')
const User = () => import('../../components/auth/user/User')
const NotFound = () => import('../../components/error-pages/NotFound')

// bussiness
const MyCompany = () => import('../../components/public/MyCompany')
const MyAccount = () => import('../../components/public/MyAccount')
const MyVendor = () => import('../../components/public/MyVendor')

const Packages = () => import('../../components/public/Packages')
const Products = () => import('../../components/public/Products')
// Toolbars
const ErrorToolbar = () => import('../../components/layouts/toolbars/ErrorToolbar')
const WelcomeToolbar = () => import('../../components/layouts/toolbars/WelcomeToolbar')
const UserToolbar = () => import('../../components/layouts/toolbars/UserToolbar')

// Layouts
const PublicLayout = () => import('../../components/layouts/master-layouts/PublicLayout')
const UserLayout = () => import('../../components/layouts/master-layouts/UserLayout')
const ErrorLayout = () => import('../../components/layouts/master-layouts/ErrorLayout')

// Footers
const AppFooter = () => import('../../components/layouts/footers/AppFooter')

export {
  Welcome,
  Packages,
  Products,
  MyCompany,
  MyAccount,
  MyVendor,
  User,
  NotFound,
  ErrorToolbar,
  WelcomeToolbar,
  UserToolbar,
  PublicLayout,
  UserLayout,
  ErrorLayout,
  AppFooter
}

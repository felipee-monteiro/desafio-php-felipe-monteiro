import { wTrans } from "laravel-vue-i18n";

/**
 * Obtém o valor internacionalizado (i18n) correspondente à chave fornecida.
 *
 * Esta função verifica se a chave fornecida é uma string válida (não vazia) e, em seguida,
 * retorna o valor traduzido associado.
 *
 * @param {string} key - A chave utilizada para buscar o valor internacionalizado.
 * Deve ser uma string não vazia.
 *
 * @returns {string} O valor internacionalizado correspondente à chave fornecida.
 *
 * @throws {TypeError} Se a `key` não for uma string válida ou estiver vazia.
 *
 * @example
 * // Retorna a tradução correspondente à chave 'welcome.message'
 * const translatedMessage = getI18NValueByKey('welcome.message');
 */
export function getPTBRI18NValueByKey(key) {
    if (typeof key !== "string" || !key.trim().length) {
        throw new TypeError("The \"key\" property MUST be a valid string");
    }

    return wTrans(key);
}

export const PT_BR_LABELS = {
    // Auth
    "email": getPTBRI18NValueByKey("E-Mail Address"),
    "login": getPTBRI18NValueByKey("Login"),
    "logout": getPTBRI18NValueByKey("Log Out"),
    "password": getPTBRI18NValueByKey("Password"),
    "confirm_password": getPTBRI18NValueByKey("Confirm Password"),
    "remember_me": getPTBRI18NValueByKey("Remember Me"),
    "forgot_password": getPTBRI18NValueByKey("Forgot Your Password?"),
    "dont_have_account": getPTBRI18NValueByKey("Don't have an account?"),
    "signup": getPTBRI18NValueByKey("Sign up"),

    // Auth::Register
    "name": getPTBRI18NValueByKey('Name'),
    "register": getPTBRI18NValueByKey('Register'),
    "already_registered": getPTBRI18NValueByKey("Already registered?"),

    // Auth::ForgotPassword
    "forgot_pass_long": getPTBRI18NValueByKey("Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one."),
    "email_password_reset_link": getPTBRI18NValueByKey('Email Password Reset Link'),
    "i_agree_to_the": "Eu concordo",
    "terms_of_services": "Termos de Serviço",
    "and": "e",
    "with": "com",
    "the_female_plural": "as",
    "privacy_policy": "Políticas de privacidade",
    "reset_password": getPTBRI18NValueByKey("Reset Password"),

    //Auth::validate_email
    "Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.": getPTBRI18NValueByKey("auth.email_verification"),
    "Resend Verification Email": getPTBRI18NValueByKey("auth.resend_verification_email"),
    "Edit Profile": getPTBRI18NValueByKey("auth.edit_profile"),
    "A new verification link has been sent to the email address you provided during registration.": getPTBRI18NValueByKey("A new verification link has been sent to the email address you provided during registration."),

    //Profile Managment
    "profile": getPTBRI18NValueByKey("Profile"),
    "profile.information": getPTBRI18NValueByKey("Profile Information"),
    "profile.update_info": getPTBRI18NValueByKey("Update your account profile information and email address."),
    "profile.email_unverified": getPTBRI18NValueByKey("Your email address is unverified."),
};

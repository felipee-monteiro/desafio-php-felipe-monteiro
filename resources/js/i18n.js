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
 * const translatedMessage = getPTBRI18NValueByKey('welcome.message');
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
    "Password": getPTBRI18NValueByKey("Password"),
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
    "Profile": getPTBRI18NValueByKey("Profile"),
    "Profile Information": getPTBRI18NValueByKey("Profile Information"),
    "Update your account profile information and email address.": getPTBRI18NValueByKey("Update your account profile information and email address."),
    "Your email address is unverified.": getPTBRI18NValueByKey("Your email address is unverified."),
    "Save": getPTBRI18NValueByKey('Save'),
    "Saved": getPTBRI18NValueByKey("Saved"),
    "Update Password": getPTBRI18NValueByKey("Update Password"),
    "Ensure your account is using a long, random password to stay secure.": getPTBRI18NValueByKey("Ensure your account is using a long, random password to stay secure."),
    "Current Password": getPTBRI18NValueByKey("Current Password"),
    "New Password": getPTBRI18NValueByKey("New Password"),
    "Confirm Password": getPTBRI18NValueByKey("Confirm Password"),
    "Code": getPTBRI18NValueByKey("Code"),

    // 2FA
    "Two Factor Authentication": getPTBRI18NValueByKey("Two Factor Authentication"),
    "Add additional security to your account using two factor authentication.": getPTBRI18NValueByKey("Add additional security to your account using two factor authentication."),
    "You have not enabled two factor authentication.": getPTBRI18NValueByKey("You have not enabled two factor authentication."),
    "When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.": getPTBRI18NValueByKey("When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application."),
    "Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.": getPTBRI18NValueByKey("Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost."),
    "To finish enabling two factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP code.": getPTBRI18NValueByKey("To finish enabling two factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP code."),
    "Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application or enter the setup key.": getPTBRI18NValueByKey("Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application or enter the setup key."),
    "Finish enabling two factor authentication.": getPTBRI18NValueByKey("Finish enabling two factor authentication."),
    "You have enabled two factor authentication.": getPTBRI18NValueByKey("You have enabled two factor authentication."),
    "Enable": getPTBRI18NValueByKey("Enable"),
    "Confirm": getPTBRI18NValueByKey("Confirm"),
    "Setup Key": getPTBRI18NValueByKey("Setup Key"),
    "Regenerate Recovery Codes": getPTBRI18NValueByKey("Regenerate Recovery Codes"),
    "The provided password was incorrect.": getPTBRI18NValueByKey("The provided password was incorrect."),
    "Show Recovery Codes": getPTBRI18NValueByKey("Show Recovery Codes"),
    "Cancel": getPTBRI18NValueByKey("Cancel"),
    "Disable": getPTBRI18NValueByKey("Disable"),

    "Log Out Other Browser Sessions": getPTBRI18NValueByKey("Log Out Other Browser Sessions"),

    // Sessions managment

    "Browser Sessions": getPTBRI18NValueByKey("Browser Sessions"),
    "Manage and log out your active sessions on other browsers and devices.": getPTBRI18NValueByKey("Manage and log out your active sessions on other browsers and devices."),
    "If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.": getPTBRI18NValueByKey("If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password."),
    "Unknown": getPTBRI18NValueByKey("Unknown"),
    "This device": getPTBRI18NValueByKey("This device"),
    "Done": getPTBRI18NValueByKey("Done"),
    "Done.": getPTBRI18NValueByKey("Done."),
    "Delete Account": getPTBRI18NValueByKey("Delete Account"),
    "Permanently delete your account.": getPTBRI18NValueByKey("Permanently delete your account."),
    "Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.": getPTBRI18NValueByKey("Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain."),
    "Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.": getPTBRI18NValueByKey("Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account."),
    "Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.": getPTBRI18NValueByKey("Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices."),
    "When two factor authentication is enabled, you will be prompted for a secure random token during authentication. You may retrieve this token from your phone's Google Authenticator application.": getPTBRI18NValueByKey("When two factor authentication is enabled, you will be prompted for a secure random token during authentication. You may retrieve this token from your phone's Google Authenticator application."),
    "Manage Account": getPTBRI18NValueByKey("Manage Account")
};

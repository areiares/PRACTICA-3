<?php
// helpers/valida.php

/**
 * Limpia y sana entradas de usuario para prevenir inyección de código.
 *
 * @param string $input Entrada a limpiar.
 * @return string Entrada saneada.
 */
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

/**
 * Valida si un email tiene un formato correcto.
 *
 * @param string $email Email a validar.
 * @return bool True si el email es válido, false si no.
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Valida si una contraseña cumple con los requisitos mínimos.
 * Requisitos: al menos 8 caracteres, una mayúscula, una minúscula, un número.
 *
 * @param string $password Contraseña a validar.
 * @return bool True si es válida, false si no.
 */
function isValidPassword($password) {
    return preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/', $password);
}

/**
 * Comprueba si un campo obligatorio no está vacío.
 *
 * @param string $field Valor del campo.
 * @return bool True si no está vacío, false si lo está.
 */
function isRequired($field) {
    return !empty(trim($field));
}

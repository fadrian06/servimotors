<?php

final class ClientValidator
{
  private $errors = [];

  function validateForm(array $data): bool
  {
    // Validar nombres y apellidos
    $nameRegex = '/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]{1,29}$/';

    if (!preg_match($nameRegex, $data['firstName'] ?? '')) {
      $this->errors[] = 'El primer nombre debe comenzar con mayúscula y contener solo letras';
    }

    if (!empty($data['secondName']) && !preg_match($nameRegex, $data['secondName'])) {
      $this->errors[] = 'El segundo nombre debe comenzar con mayúscula y contener solo letras';
    }

    if (!preg_match($nameRegex, $data['firstSurname'] ?? '')) {
      $this->errors[] = 'El primer apellido debe comenzar con mayúscula y contener solo letras';
    }

    if (!empty($data['secondSurname']) && !preg_match($nameRegex, $data['secondSurname'])) {
      $this->errors[] = 'El segundo apellido debe comenzar con mayúscula y contener solo letras';
    }

    // Validar cédula
    if (!preg_match("/^[VE]-[0-9]{6,8}$/", $data['cedula'] ?? '')) {
      $this->errors[] = "Formato de cédula inválido (debe ser V-XXXXXXXX o E-XXXXXXXX)";
    }

    // Validar teléfonos
    $phoneRegex = '/^(\+(\d{1,3}|\d{1}-\d{1,3}){1} \d{1,3}-\d{7,}|\d{11}){1}$/';

    if (!preg_match($phoneRegex, $data['personalPhone'] ?? '')) {
      $this->errors[] = 'El teléfono personal debe ser local (ej. 04241234567) o internacional (ej. +58 416-1231234)';
    }

    if (!empty($data['landlinePhone']) && !preg_match($phoneRegex, $data['landlinePhone'])) {
      $this->errors[] = 'El teléfono fijo debe ser local (ej. 04241234567) o internacional (ej. +58 416-1231234)';
    }

    if (!empty($data['optionalPhone']) && !preg_match($phoneRegex, $data['optionalPhone'])) {
      $this->errors[] = 'El teléfono opcional debe ser local (ej. 04241234567) o internacional (ej. +58 416-1231234)';
    }

    // Validar dirección
    $locationRegex = '/^[A-ZÁÉÍÓÚa-záéíóúñ\s]*$/';

    if (!preg_match($locationRegex, $data['state'] ?? '')) {
      $this->errors[] = 'Estado inválido';
    }

    if (!preg_match($locationRegex, $data['municipality'] ?? '')) {
      $this->errors[] = 'Municipio inválido';
    }

    if (!preg_match($locationRegex, $data['parish'] ?? '')) {
      $this->errors[] = 'Parroquia inválida';
    }

    $streetRegex = '/^[A-ZÁÉÍÓÚa-záéíóúñ0-9\s\-]{1,49}$/';

    if (!preg_match($streetRegex, $data['avenue'] ?? '')) {
      $this->errors[] = 'Avenida inválida';
    }

    if (!preg_match($streetRegex, $data['street'] ?? '')) {
      $this->errors[] = "Calle inválida";
    }

    $housingNumber = '/^(?:\d+|Sin número)$/i';

    if (!preg_match($housingNumber, $data['housingNumber'] ?? '')) {
      $this->errors[] = "Número de vivienda inválido (Debe contener números o 'Sin número')";
    }

    return empty($this->errors);
  }

  function getErrors()
  {
    return $this->errors;
  }
}

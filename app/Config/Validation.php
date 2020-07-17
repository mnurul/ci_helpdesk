<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
		\Myth\Auth\Authentication\Passwords\ValidationRules::class
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $user = [
		'username' => 'required|min_length[3]|alpha',
		'password' => 'required|min_length[3]'
	];

	public $user_errors = [
		'username' => [
			'required'      => 'Username wajib kamu isi',
			'min_length[3]'      => 'Username kamu harus lebih dari 3',
			'alpha'      => 'Username kamu harus alphabetic '
		],
		'password' => [
			'required'      => 'password wajib kamu isi',
			'min_length[3]'      => 'password kamu harus lebih dari 3'
		]
	];

	public $change_password = [
		'password' => 'required|min_length[3]',
		'cpassword' => 'required|min_length[3]|matches[password]'
	];

	public $change_password_errors = [
		'password' => [
			'required'      => 'Password wajib kamu isi1',
			'min_length[3]'      => 'Password kamu harus lebih dari 3'
		],
		'cpassword' => [
			'required'      => 'Password wajib kamu isi2',
			'min_length[3]'      => 'Password kamu harus lebih dari 3',
			'matches'      => 'Password tidak cocok'
		]
	];
}

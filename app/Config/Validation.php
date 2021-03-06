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
			'required'      => 'Password kmau wajib kamu isi2',
			'min_length[3]'      => 'Password kamu harus lebih dari 3',
			'matches'      => 'Password kamu tidak cocok'
		]
	];

	public $forgot_password = [
		'email' => 'required|trim|valid_email'
	];

	public $forgot_password_errors = [
		'email' => [
			'required'      => 'Email kamu wajib kamu isi1',
			'valid_email'      => 'Email kamu tidak valid '
		]
	];

	public $create_user = [
		'iduser' => 'required',
		'username' => 'required',
		'password' => 'required|min_length[3]',
		'fullname' => 'required',
		'email' => 'required|trim|valid_email|is_unique[users.email]',
		'telp' => 'required'
	];

	public $create_user_errors = [
		'iduser' => [
			'required'      => 'Iduser wajib kamu isi'
		],
		'username' => [
			'required'      => 'Username wajib kamu isi'
		],
		'password' => [
			'required'      => 'Password wajib kamu isi',
			'min_length'      => 'Password harus lebih dari 3'
		],
		'fullname' => [
			'required'      => 'Fullname wajib kamu isi'
		],
		'email' => [
			'required'      => 'Email wajib kamu isi1',
			'valid_email'      => 'Email tidak valid ',
			'is_unique'      => 'Email tidak unik'
		],
		'telp' => [
			'required'      => 'Telpon wajib kamu isi'
		]
	];
	public $edit_user = [
		'iduser' => 'required',
		'username' => 'required',
		'level' => 'required',
		'fullname' => 'required',
		'email' => 'required|trim|valid_email',
		'telp' => 'required'
	];

	public $edit_user_errors = [
		'iduser' => [
			'required'      => 'Iduser wajib kamu isi'
		],
		'username' => [
			'required'      => 'Username wajib kamu isi'
		],
		'level' => [
			'required'      => 'Level wajib kamu isi'
		],
		'fullname' => [
			'required'      => 'Fullname wajib kamu isi'
		],
		'email' => [
			'required'      => 'Email wajib kamu isi1',
			'valid_email'      => 'Email tidak valid '
		],
		'telp' => [
			'required'      => 'Telpon wajib kamu isi'
		]
	];
	// trim buat hapus spasi didepan atau belakang data

	public $change_password_u = [
		'oldpassword' => 'required|min_length[3]',
		'newpassword' => 'required|min_length[3]',
		'cpassword' => 'required|min_length[3]|matches[newpassword]'
	];

	public $change_password_u_errors = [
		'oldpassword' => [
			'required'      => 'Password wajib kamu isi1',
			'min_length[3]'      => 'Password kamu harus lebih dari 3'
		],
		'newpassword' => [
			'required'      => 'Password wajib kamu isi1',
			'min_length[3]'      => 'Password kamu harus lebih dari 3'
		],
		'cpassword' => [
			'required'      => 'Password kmau wajib kamu isi2',
			'min_length[3]'      => 'Password kamu harus lebih dari 3',
			'matches'      => 'Password kamu tidak cocok'
		]
	];

	public $create_cs = [
		'idcustomer' => 'required',
		'csnama' => 'required',
		'alamat' => 'required',
		'telp' => 'required',
		'email' => 'required|trim|valid_email|is_unique[customers.email]',
		'pic' => 'required',
		// 'csproduct' => 'required'
	];

	public $create_cs_errors = [
		'idcustomer' => [
			'required'      => 'Idcustomer wajib kamu isi'
		],
		'csnama' => [
			'required'      => 'Nama wajib kamu isi'
		],
		'alamat' => [
			'required'      => 'Alamat wajib kamu isi'
		],
		'telp' => [
			'required'      => 'Telpon wajib kamu isi'
		],
		'email' => [
			'required'      => 'Email wajib kamu isi1',
			'valid_email'      => 'Email tidak valid ',
			'is_unique'      => 'Email tidak unik'
		],
		'pic' => [
			'required'      => 'PIC wajib kamu isi'
		],
		// 'csproduct' => [
		// 	'required'      => 'Product wajib kamu isi'
		// ]
	];

	public $edit_customer = [
		'idcustomer' => 'required',
		'csnama' => 'required',
		'alamat' => 'required',
		'telp' => 'required',
		'email' => 'required|trim|valid_email',
		'pic' => 'required'
	];

	public $edit_customer_errors = [
		'idcustomer' => [
			'required'      => 'Idcustomer wajib kamu isi'
		],
		'csnama' => [
			'required'      => 'Nama wajib kamu isi'
		],
		'alamat' => [
			'required'      => 'Alamat wajib kamu isi'
		],
		'telp' => [
			'required'      => 'Telpon wajib kamu isi'
		],
		'email' => [
			'required'      => 'Email wajib kamu isi1',
			'valid_email'      => 'Email tidak valid '
		],
		'pic' => [
			'required'      => 'PIC wajib kamu isi'
		]
	];

	public $create_ticket = [
		'rby' => 'required',
		// 'psummary' => 'required',
		// 'pdetail' => 'required'
	];

	public $create_ticket_errors = [
		'rby' => [
			'required'      => 'Report By wajib kamu isi'
		],
		'psummary' => [
			'required'      => 'Problem Summary wajib kamu isi'
		],
		'pdetail' => [
			'required'      => 'Problem Detail wajib kamu isi'
		]
	];

	public $create_pjt = [
		'wperiod' => 'integer',
		'cenddate' => 'integer'
	];

	public $create_pjt_errors = [
		'wperiod' => [],
		'cenddate' => [
			'integer'      => 'Contract End Date harus berisi angka',
		]
	];

	public $edit_word = [
		'word' => 'required',
		'c_word' => 'required',
	];

	public $edit_word_errors = [
		'word' => [
			'required'      => 'Word wajib kamu isi'
		],
		'c_word' => [
			'required'      => 'Correct Word wajib kamu isi'
		]
	];
}

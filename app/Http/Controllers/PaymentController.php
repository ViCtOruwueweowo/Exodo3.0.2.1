<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\Rental;
use App\Models\Film;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        // Obtener todos los pagos con las relaciones necesarias
        $payments = Payment::with(['customer', 'staff', 'rental'])->paginate(10);

        // Pasar los pagos a la vista
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        // Obtener los clientes, empleados y alquileres disponibles
        $customers = Customer::all();
        $staff = Staff::all();
        $rentals = Rental::all();
        // Retornar la vista con los datos necesarios
        return view('payments.create', compact('customers', 'staff', 'rentals'));
    }

    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'customer_id' => 'required|exists:customer,customer_id',
            'staff_id' => 'required|exists:staff,staff_id',
            'amount' => 'required|numeric',
            'rental_id' => 'nullable|exists:rental,rental_id',
        ]);

        // Crear un nuevo pago
        Payment::create($request->all());

        // Redirigir a la lista de pagos con mensaje de éxito
        return redirect()->route('Payments.show')->with('success', 'Pago creado con éxito');
    }

        // Método para mostrar el formulario de edición
    public function edit($paymentId)
    {
        $payment = Payment::findOrFail($paymentId); // Obtener el pago por su ID
        $customers = Customer::all(); // Obtener todos los clientes
        $staffs = Staff::all(); // Obtener todos los empleados
        $rentals = Rental::all(); // Obtener todos los rentals (si es necesario)

        return view('Payments.edit', compact('payment', 'customers', 'staffs', 'rentals'));
    }

    public function update(Request $request, $paymentId)
{
    // Validar la entrada
    $request->validate([
        'customer_id' => 'required|exists:customer,customer_id',
        'staff_id' => 'required|exists:staff,staff_id',
        'rental_id' => 'nullable|exists:rental,rental_id', // Si es opcional
        'amount' => 'required|numeric',
        'payment_date' => 'required|date',
    ]);

    // Obtener el pago a editar
    $payment = Payment::findOrFail($paymentId);

    // Actualizar los campos
    $payment->update($request->all());

    // Redirigir con un mensaje de éxito
    return redirect()->route('Payments.show')->with('success', 'Pago actualizado con éxito');
}

public function destroy($paymentId)
{
    // Buscar el pago por su ID
    $payment = Payment::findOrFail($paymentId);

    // Eliminar el pago
    $payment->delete();

    // Redirigir a la lista de pagos con un mensaje de éxito
    return redirect()->route('Payments.show')->with('success', 'Pago eliminado con éxito');
}

}

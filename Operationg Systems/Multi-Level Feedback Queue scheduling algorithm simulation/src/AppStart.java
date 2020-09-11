import java.awt.EventQueue;
import javax.swing.JFrame;
import javax.swing.JTextField;
import javax.swing.JLabel;
import javax.swing.JOptionPane;

import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import javax.swing.JTextArea;
import java.awt.Font;
import javax.swing.JScrollPane;

public class AppStart {

	private JFrame frame;
	private JTextField processId;
	private JTextField processCpuTime;
	
	public JTextArea reportTxtArea;
	public Scheduler MainScheduler;
	private JButton btnStart;
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					AppStart window = new AppStart();
					window.frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the application.
	 */
	public AppStart() {
		initialize();
	}

	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		
		frame = new JFrame();
		frame.setBounds(100, 100, 420, 615);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.getContentPane().setLayout(null);
		
		processId = new JTextField();
		processId.setBounds(111, 11, 281, 20);
		frame.getContentPane().add(processId);
		processId.setColumns(10);
		
		JLabel lblNewLabel = new JLabel("Process Id");
		lblNewLabel.setFont(new Font("Tahoma", Font.PLAIN, 14));
		lblNewLabel.setBounds(10, 11, 73, 17);
		frame.getContentPane().add(lblNewLabel);
		
		JLabel lblProcessCpuTime = new JLabel("CPU Time");
		lblProcessCpuTime.setFont(new Font("Tahoma", Font.PLAIN, 14));
		lblProcessCpuTime.setBounds(10, 40, 106, 20);
		frame.getContentPane().add(lblProcessCpuTime);
		
		processCpuTime = new JTextField();
		processCpuTime.setColumns(10);
		processCpuTime.setBounds(111, 42, 281, 20);
		frame.getContentPane().add(processCpuTime);
		
		
		JButton btnNewButton = new JButton("Add Process");
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				String idText = processId.getText();
				String cpuTimeText = processCpuTime.getText();				
				

				if(!isNumber(idText) || !isNumber(cpuTimeText))
				{
					JOptionPane.showMessageDialog(null, "All Fields Must Be Numeric Integers!", "Input Error", JOptionPane.ERROR_MESSAGE);
					return;
				}			
				
				int id = Integer.parseInt(idText);			
				long cpuTime = Long.parseLong(cpuTimeText);
				
				
				MainScheduler.AddNewProcess(new Process(id, cpuTime));
				reportTxtArea.append("Process Id: " + id + " has been added. Cpu time required = " + cpuTimeText + "\n");		
			}
		});
		
		
		btnNewButton.setBounds(10, 71, 140, 31);
		frame.getContentPane().add(btnNewButton);
		
		btnStart = new JButton("Start!");
		btnStart.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {

				btnStart.setEnabled(false);
				btnNewButton.setEnabled(false);
				
				Thread scheduleThread = new Thread(MainScheduler);
				scheduleThread.start();
				
				btnStart.setEnabled(true);
				btnNewButton.setEnabled(true);
			}
		});
		btnStart.setBounds(288, 71, 106, 31);
		frame.getContentPane().add(btnStart);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(10, 113, 382, 452);
		frame.getContentPane().add(scrollPane);
		
		reportTxtArea = new JTextArea();
		scrollPane.setViewportView(reportTxtArea);
		
		MainScheduler = new Scheduler(reportTxtArea);
	}
	
	
	
	public boolean isNumber(String num)
	{
		if(num.length() == 0) return false;
		
		for(char c : num.toCharArray())
		{
			if (!Character.isDigit(c)) return false;
		}
		
		return true;
	}
}























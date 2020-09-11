import java.util.LinkedList;

public class QueueHandler {
    public LinkedList<Process> Processes;
    public int PriorityLevel;
    public long Quantum;
    public long QuantumClock;
    public Scheduler SchedulerObj;
    public int AgingFactor = 0;
    
    public QueueHandler(Scheduler scheduler, long quantum, int priorityLevel)
    {
        Processes = new LinkedList<Process>();
        // The queue's priority level; the lower the number, the higher the priority
        
        
        PriorityLevel = priorityLevel;
        
        if(priorityLevel != 1)
        	AgingFactor = (int) (priorityLevel * 2);
        
        SchedulerObj = scheduler;
        
        SchedulerObj.appendOutput("Queue with priority level " + priorityLevel + " has been added. Quantum = " +  quantum);
        // The queue's allotted time slice; each process in this queue is executed for this amount of time in total
        // This may be done over multiple scheduler iterations
        Quantum = quantum;
        
        
        // A counter to keep track of how much time the queue has been executing so far
        QuantumClock = 0;
    }

    public void Enqueue(Process process)
    {
        process.setParentQueue(this);
        Processes.addLast(process);
    }

    public Process Dequeue()
    {
        Process elm = Processes.getFirst();
        Processes.removeFirst();
        return elm;
    }

    public Process Peek()
    {
        return Processes.getFirst();
    }

    public boolean IsEmpty()
    {
        return Processes.isEmpty();
    }

    // Manages a process's execution for the given amount of time
    // Processes that have had their states changed should not be affected
    // Once a process has received the alloted time, it needs to be dequeue'd and 
    // then handled accordingly, depending on whether it has finished executing or not
    public void ManageTimeSlice(Process currentProcess, long time)
    {
        // process needs to be handled by another queue
        if (currentProcess.IsStateChanged)
        {
            // reset the quantumClock counter
            QuantumClock = 0;
            return;
        }

        QuantumClock = QuantumClock + time;
        if (QuantumClock >= Quantum)
        {
            QuantumClock = 0;
            Process process = this.Dequeue();

            if (!process.IsFinished())
            {
                SchedulerObj.handleInterrupt(this, process, SchedulerInterrupt.LOWER_PRIORITY);
            }
            else
            {
            	this.SchedulerObj.appendOutput("Process " + process.Pid + " finished!");
            }
        }
        
        if(currentProcess.IsFinished())
        {
        	 QuantumClock = 0;
             Process process = this.Dequeue();
             this.SchedulerObj.appendOutput("Process " + process.Pid + " finished!");
        }
        
    }

    // Execute the next non-blocking process (assuming this is a CPU queue)
    // This method should call `manageTimeSlice` as well as execute the next running process
    public void DoCPUWork()
    {
        Process process = Peek();
        SchedulerObj.appendOutput("Time = " + SchedulerObj.Clock + ". Assigned Process:" + process.Pid);

        process.executeProcess(1);
        ManageTimeSlice(process, 1);
    }    
    
    public void updateAgingProcesses()
    {
    	for(int i = 0; i < Processes.size(); i++ )
    	{
    		Processes.get(i).TimeInQueue++;
    	}
    }
    
    public void checkAgingProcesses()
    {
    	for(int i = 0; i < Processes.size(); i++ )
    	{
    		if(Processes.get(i).TimeInQueue >= AgingFactor)
    		{
    			Process p = Processes.get(i);
    			p.TimeInQueue = 0;
    			Processes.remove(i);
    			SchedulerObj.handleInterrupt(this, p, SchedulerInterrupt.HIGHER_PRIORITY);
    		}
    	}
    }
}

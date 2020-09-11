import java.util.ArrayList;
import java.util.List;

import javax.swing.JTextArea;

public class Scheduler implements Runnable {
	
    public static int PRIORITY_LEVELS = 3;

    public List<QueueHandler> RunningQueues;
    public long TotalTime;
    private JTextArea OutputControl;
    public long Clock;
    int currentQueue;
    
    public Scheduler(JTextArea output)
    {
    	OutputControl = output;
    	TotalTime = 0;
        RunningQueues = new ArrayList<QueueHandler>();
        Clock = 1;
        currentQueue = 1;
        // Initialize all the CPU running queues
        for (int i = 1; i <= PRIORITY_LEVELS; i++)
        {
            RunningQueues.add(new QueueHandler(this, 3 * i/*this is the quantum (time slice) for each queue*/, i));
        }
    }

    public void run()
    {
        while (true)
        {
        	
        	// do some work on the running queues
            for (int i = 0; i < PRIORITY_LEVELS; i++)
            {
                QueueHandler queueHandler = RunningQueues.get(i);
                if (!queueHandler.IsEmpty())
                {
                	if(i != currentQueue)
                	{
                		currentQueue = i;
                		appendOutput("Executing in queue " + (currentQueue + 1));
                	}
                    queueHandler.DoCPUWork();
                    Clock++;
                    break;
                }
            }

            
            
            // check if all the queues are empty
            if (AllQueuesEmpty())
            {            	
            	appendOutput("Total time: " + (TotalTime) + " ms");
            	appendOutput("Idle mode");
            	TotalTime = 0;
                break;
            }
            
            for (int i = 1; i < PRIORITY_LEVELS; i++)
            {
            	QueueHandler queueHandler = RunningQueues.get(i);
            	if (!queueHandler.IsEmpty())
                {
                	if(i != currentQueue & i != 0)
                	{
                		queueHandler.updateAgingProcesses();
                		queueHandler.checkAgingProcesses();
                	}
                }
            }
        }
    }

    public boolean AllQueuesEmpty()
    {
    	for(QueueHandler q : RunningQueues)
    	{
    		if(!q.IsEmpty()) return false;
    	}
    	    	
        return true;
    }

    public void AddNewProcess(Process process)
    {
    	TotalTime += process.CpuTimeNeeded;
        // new processes will only ever get added to the top-level running queue
        RunningQueues.get(0).Enqueue(process);
    }

    // The scheduler's interrupt handler that receives a queue, a process, and an interrupt string constant
    // Should handle PROCESS_BLOCKED, PROCESS_READY, and LOWER_PRIORITY interrupts.
    void handleInterrupt(QueueHandler queueHandler, Process process, SchedulerInterrupt interrupt)
    {
        switch (interrupt)
        {
            case PROCESS_READY:
                AddNewProcess(process);
                break;
            case LOWER_PRIORITY:
                int priorityLevel = Math.min(PRIORITY_LEVELS , queueHandler.PriorityLevel + 1);
                 if(priorityLevel != process.ParentQueue.PriorityLevel){
                  appendOutput("Process " + process.Pid + " moved to lower priority queue " + (priorityLevel));}
                    RunningQueues.get(priorityLevel - 1).Enqueue(process);
              break;
            case HIGHER_PRIORITY:
            	process.TimeInQueue = 0;
                int priority = Math.max(0, queueHandler.PriorityLevel - 1);
                RunningQueues.get(priority - 1).Enqueue(process);
                appendOutput("Process " + process.Pid + " have aged and moved to higher priority queue " + priority);
            	break;
            default:
                break;
        }
    }
    
    public void appendOutput(String text)
    {
    	OutputControl.append(" " + text + "\n");
    }
}

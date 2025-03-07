import React from 'react';
import {
  LineChart,
  Line,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  Legend,
  ResponsiveContainer
} from 'recharts';

const SalesDashboardChart = () => {
  // Sample data structure that matches your Laravel controller
  const data = [
    {
      date: 'Jan 01',
      sales: 4000,
      orders: 24
    },
    {
      date: 'Jan 02',
      sales: 3000,
      orders: 18
    },
    // ... more data will be passed from Laravel
  ];

  const formatYAxis = (value) => `$${value}`;

  return (
    <div className="w-full h-80">
      <ResponsiveContainer width="100%" height="100%">
        <LineChart
          data={data}
          margin={{
            top: 20,
            right: 30,
            left: 20,
            bottom: 5,
          }}
        >
          <CartesianGrid strokeDasharray="3 3" className="stroke-gray-200" />
          <XAxis 
            dataKey="date"
            stroke="#6B7280"
            fontSize={12}
            tickLine={false}
          />
          <YAxis
            stroke="#6B7280"
            fontSize={12}
            tickFormatter={formatYAxis}
            tickLine={false}
          />
          <Tooltip
            contentStyle={{
              backgroundColor: '#fff',
              border: '1px solid #e5e7eb',
              borderRadius: '0.5rem',
              fontSize: '12px'
            }}
            formatter={(value, name) => [
              name === 'sales' ? `$${value}` : value,
              name.charAt(0).toUpperCase() + name.slice(1)
            ]}
          />
          <Legend 
            verticalAlign="top" 
            height={36}
          />
          <Line
            type="monotone"
            dataKey="sales"
            stroke="#3B82F6"
            strokeWidth={2}
            dot={false}
            activeDot={{ r: 8 }}
            name="Sales"
          />
          <Line
            type="monotone"
            dataKey="orders"
            stroke="#10B981"
            strokeWidth={2}
            dot={false}
            activeDot={{ r: 8 }}
            name="Orders"
          />
        </LineChart>
      </ResponsiveContainer>
    </div>
  );
};

export default SalesDashboardChart;